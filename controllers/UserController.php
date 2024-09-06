<?php
session_start();
require_once '../config/Database.php';
require_once '../models/User.php';

class UserController {
    private $user;

    public function __construct() {
        $db = new Database();
        $this->user = new User($db->getConnection());
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            if ($this->user->registerUser($name, $surname, $email, $hashedPassword)) {
                include("../views/login.php");
                echo '<br><h1 class="message-successful">¡Se registró EXITOSAMENTE!</h1>';
            } else {
                echo "Error al insertar datos";
            }
        } else {
            include("../views/signup.php");
        }
    }

    public function __destruct() {
        $this->user->close();
    }
}

$userController = new UserController();
$userController->register();
?>
