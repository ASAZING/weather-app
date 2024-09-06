<?php
require_once '../models/Weather.php';

class WeatherService
{
    private $apiKey = 'ec3cd460a4f6670c75ca0bfcf76f2b40';
    private $apiUrl = 'https://api.openweathermap.org/data/2.5/weather';
    private $weather;

    public function __construct($dbConnection)
    {
        $this->weather = new Weather($dbConnection);
    }

    public function getWeather($city)
    {
        $url = "{$this->apiUrl}?q={$city}&appid={$this->apiKey}&units=metric";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        $this->storeWeatherData($data);
        return $data;
    }

    public function getWeatherByCoordinates($lat, $lon)
    {
        $url = "{$this->apiUrl}?lat={$lat}&lon={$lon}&appid={$this->apiKey}&units=metric";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        $this->storeWeatherData($data);
        return $data;
    }


    public function getWeathersByUserId($userId) {
        return $this->weather->getWeathersByUserId($userId);
    }

    private function storeWeatherData($data)
    {
        $this->weather->registerWeather($data);
    }
}
