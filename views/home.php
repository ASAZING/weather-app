<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../views/login.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">WeatherApp</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../views/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="weather-card">
            <h3 class="text-center">Weather Information</h3>
            <div id="weather" class="weather-info">Loading weather...</div>

            <form id="city-form" class="form-inline" onsubmit="handleCitySubmit(event)">
                <input type="text" id="city" class="form-control mr-2" placeholder="Enter city" required>
                <button type="submit" class="btn btn-primary">Get Weather</button>
            </form>
        </div>

        <div class="weather-card history-table">
            <h3 class="text-center">Weather History</h3>
            <table id="history" class="table table-striped">
                <thead>
                    <tr>
                        <th>City</th>
                        <th>Temperature</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Weather history will be populated here -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showWeather, handleError);
            } else {
                document.getElementById('weather').innerText = 'Geolocation is not supported by this browser.';
            }
        });

        function showWeather(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            const date = new Date();

            fetch(`../controllers/WeatherController.php?lat=${lat}&lon=${lon}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        document.getElementById('weather').innerText = data.error;
                        return;
                    }
                    const temp = data.main.temp;
                    const description = data.weather[0].description;
                    const city = data.name;
                    document.getElementById('weather').innerHTML = `
                        <strong>City:</strong> ${city}<br>
                        <strong>Temperature:</strong> ${temp}°C<br>
                        <strong>Description:</strong> ${description}<br>
                        <strong>Date:</strong> ${date}
                    `;
                    getHistory();

                })
                .catch(error => {
                    document.getElementById('weather').innerText = 'Error fetching weather data.';
                });
        }

        function getHistory() {
            fetch(`../controllers/WeatherController.php?getHistory=true`)
                .then(response => response.json())
                .then(historyData => {
                    const tbody = document.getElementById('history').getElementsByTagName('tbody')[0];
                    tbody.innerHTML = '';

                    historyData.forEach(record => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                                    <td>${record.city}</td>
                                    <td>${record.temperature}°C</td>
                                    <td>${record.description}</td>
                                    <td>${record.date}</td>
                                `;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error fetching weather history:', error);
                });
        }

        function handleCitySubmit(event) {
            event.preventDefault();
            const city = document.getElementById('city').value;

            fetch(`../controllers/WeatherController.php?city=${city}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        document.getElementById('weather').innerText = data.error;
                        return;
                    }
                    const temp = data.main.temp;
                    const description = data.weather[0].description;
                    const city = data.name;
                    const date = new Date();
                    document.getElementById('weather').innerHTML = `
                        <strong>City:</strong> ${city}<br>
                        <strong>Temperature:</strong> ${temp}°C<br>
                        <strong>Description:</strong> ${description}<br>
                        <strong>Date:</strong> ${date}
                    `;
                    getHistory();
                })
                .catch(error => {
                    document.getElementById('weather').innerText = 'Error fetching weather data.';
                });
        }

        function handleError(error) {
            console.error('Error getting geolocation:', error);
            document.getElementById('weather').innerText = 'Error retrieving your location.';
        }
    </script>
</body>

</html>