<?php
session_start();
require_once '../config/Database.php';
require_once '../models/User.php';

class UserController
{
    private $user;

    public function __construct()
    {
        try {
            $db = new Database();
            $this->user = new User($db->getConnection());
        } catch (Exception $e) {
            $this->handleError('Error al conectar con la base de datos: ' . $e->getMessage());
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                if ($this->user->getUserIdByEmail($email)) {
                    include("../views/signup.php");
                    echo '<br><h1 class="message-error">¡Este correo ya está registrado!</h1>';
                    exit();
                }

                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                if ($this->user->registerUser($name, $surname, $email, $hashedPassword)) {
                    include("../views/login.php");
                    echo '<br><h1 class="message-successful">¡Se registró EXITOSAMENTE!</h1>';
                    exit();
                } else {
                    throw new Exception('Error al insertar datos en la base de datos');
                }
            } catch (Exception $e) {
                $this->handleError($e->getMessage());
            }
        } else {
            include("../views/signup.php");
        }
    }

    private function handleError($message)
    {
        echo '<br><h1 class="message-error">' . htmlspecialchars($message) . '</h1>';
        exit();
    }

    public function __destruct()
    {
        $this->user->close();
    }
}

$userController = new UserController();
$userController->register();
