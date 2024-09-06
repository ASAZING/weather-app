<?php

class Weather
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    public function registerWeather($data)
    {
        try {
            $city = $data['name'] ?? null;
            $temp = $data['main']['temp'] ?? null;
            $description = $data['weather'][0]['description'] ?? null;
            $date = date('Y-m-d H:i:s');
            $user_id = $_SESSION['user_id'];
            if (!$city || !$temp || !$description) {
                throw new Exception('Faltan datos requeridos para registrar el clima.');
            }

            $stmt = $this->conn->prepare("INSERT INTO weather_logs (city, temperature, description, date, user_id) VALUES (?, ?, ?, ?, ?)");

            if (!$stmt) {
                throw new Exception('Error preparando la consulta SQL: ' . $this->conn->error);
            }

            if (!$stmt->execute([$city, $temp, $description, $date, $user_id])) {
                throw new Exception('Error ejecutando la consulta SQL: ' . $stmt->error);
            }

            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log('Error al registrar el clima: ' . $e->getMessage());
            return false;
        }
    }

    public function getWeathersByUserId($userId) {
        $query = "SELECT * FROM weather_logs WHERE user_id = ? order by id desc";
        $stmt = $this->conn->prepare($query);
    
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->conn->error);
        }
    
        $stmt->bind_param("i", $userId);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $weathers = [];
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $weathers[] = $row;
            }
            $stmt->close();
        } else {
            throw new Exception("Error executing query: " . $this->conn->error);
        }
    
        return $weathers;
    }
    


    public function close()
    {
        $this->conn = null;
    }
}
