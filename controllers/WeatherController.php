<?php
session_start();

require_once '../config/Database.php';
require_once '../services/WeatherService.php';

class WeatherController
{
    private $weatherService;

    public function __construct()
    {
        $db = new Database();
        $this->weatherService = new WeatherService($db->getConnection());
    }

    public function getWeatherByCity($city)
    {
        try {
            $data = $this->weatherService->getWeather($city);
            $this->sendJsonResponse($data);
        } catch (Exception $e) {
            $this->sendErrorResponse($e->getMessage());
        }
    }

    public function getWeatherByCoordinates($lat, $lon)
    {

        try {
            $data = $this->weatherService->getWeatherByCoordinates($lat, $lon);
            $this->sendJsonResponse($data);
        } catch (Exception $e) {
            $this->sendErrorResponse($e->getMessage());
        }
    }

    public function getWeathersByUserId($userId)
    {

        try {
            $data = $this->weatherService->getWeathersByUserId($userId);
            $this->sendJsonResponse($data);
        } catch (Exception $e) {
            $this->sendErrorResponse($e->getMessage());
        }
    }

    private function sendJsonResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    private function sendErrorResponse($message)
    {
        header('Content-Type: application/json', true, 500);
        echo json_encode(['error' => $message]);
        exit();
    }
}


$controller = new WeatherController();

if (isset($_GET['city'])) {
    $city = htmlspecialchars($_GET['city']);
    return $controller->getWeatherByCity($city);
} elseif (isset($_GET['lat']) && isset($_GET['lon'])) {
    $lat = htmlspecialchars($_GET['lat']);
    $lon = htmlspecialchars($_GET['lon']);
    return $controller->getWeatherByCoordinates($lat, $lon);
} else if (isset($_GET['getHistory']) && $_GET['getHistory'] && isset($_SESSION['user_id'])) {

    return $controller->getWeathersByUserId($_SESSION['user_id']);
} else {
    exit();
    header("Location: ../views/login.php?error=1");
    header('Content-Type: application/json', true, 400);
    echo json_encode(['error' => 'Parámetros inválidos o usuario no autenticado.']);
}
