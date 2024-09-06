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
 En el archivo config/Database.php, configura los detalles de tu servidor MySQL
 ```bash
  define('DB_HOST', 'localhost');       
   define('DB_USER', 'tu_usuario');    
   define('DB_PASS', 'tu_contraseña');   
   define('DB_NAME', 'clima');
```

## Inicia el servidor desde consola:

 ```bash
 php -S localhost:8000

```
## Xampp
1. Instala y Configura XAMPP
Descarga e Instala XAMPP:

Visita la página oficial de XAMPP.
Descarga el instalador correspondiente a tu sistema operativo (Windows, macOS, o Linux).
Ejecuta el instalador y sigue las instrucciones para completar la instalación.
Inicia XAMPP:

Abre el Panel de Control de XAMPP.
Inicia los servicios necesarios: Apache (para el servidor web) y MySQL (para la base de datos). Haz clic en "Start" junto a cada uno.
2. Configura la Base de Datos
Accede a phpMyAdmin:

Abre tu navegador y visita http://localhost/phpmyadmin.
Crea una nueva base de datos. Puedes hacerlo en la pestaña "Base de datos" de phpMyAdmin.
Importa la Estructura de la Base de Datos:

En phpMyAdmin, selecciona la base de datos que acabas de crear.
Ve a la pestaña "Importar" y selecciona el archivo SQL que contiene la estructura de tu base de datos.
Haz clic en "Continuar" para importar el archivo.

3. Configura la Aplicación
Coloca el Proyecto en la Carpeta de htdocs:

Copia la carpeta de tu proyecto a la carpeta htdocs dentro del directorio de instalación de XAMPP. Por lo general, esta carpeta está ubicada en C:\xampp\htdocs en Windows.

4. Accede a la Aplicación
Abre el Navegador:

En tu navegador web, visita http://localhost/nombre_de_tu_proyecto.
Reemplaza nombre_de_tu_proyecto con el nombre de la carpeta de tu proyecto que colocaste en htdocs.

Verifica el Funcionamiento:

Si todo está configurado correctamente, deberías ver tu aplicación en funcionamiento. Verifica que puedas acceder a las funcionalidades principales como la consulta del clima y la visualización de datos.

5. Configuración Adicional (Opcional)
Permitir acceso a la ubicación en sitios no seguros:

Si estás trabajando en un entorno local y necesitas permitir el acceso a la ubicación en un sitio no seguro (HTTP), sigue estos pasos:

Google Chrome:

Abre el sitio en Google Chrome.
Haz clic en el ícono de candado o advertencia en la barra de direcciones.
Selecciona "Configuración del sitio".
En "Ubicación", selecciona "Permitir".
Microsoft Edge:

Abre el sitio en Microsoft Edge.
Haz clic en el ícono de candado o advertencia en la barra de direcciones.
Selecciona "Permisos para este sitio".
Busca "Ubicación" y selecciona "Permitir".
