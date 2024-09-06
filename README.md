# 🌤️ Clima App

Esta es una aplicación web que permite a los usuarios consultar el clima actual de su ubicación mediante una integración con una API de clima. Los usuarios pueden visualizar información meteorológica en tiempo real y acceder a su historial de consultas.

## 🚀 Características

- Consulta del clima actual usando geolocalización o ingresando manualmente la ciudad.
- Muestra detalles como la temperatura, la descripción del clima y la ciudad.
- Historial de consultas del clima almacenado para usuarios autenticados.
- Interfaz responsiva y amigable con Bootstrap.
- Función de cron jobs para consultar el clima automáticamente.

## 🛠️ Requisitos

- **PHP** (7.4 o superior)
- **MySQL** para la base de datos
- **API Key** de [OpenWeatherMap](https://openweathermap.org/) para la integración de clima.

## 📦 Instalación

1. **Clona el repositorio:**
   ```bash
   git clone https://github.com/tuusuario/clima-app.git
   cd clima-app

## 📦 Configura la conexión a la base de datos:

 ```bash
   En el archivo config/Database.php, configura los detalles de tu servidor MySQL

