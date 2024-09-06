<?php
require_once '../config/Database.php';
require_once '../models/User.php';
session_start();

class AuthController {
    private $user;

    public function __construct() {
        $db = new Database();
        $this->user = new User($db->getConnection());
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $hashedPassword = $this->user->getPasswordHashByEmail($email);

            if ($hashedPassword && password_verify($password, $hashedPassword)) {
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $this->user->getUserIdByEmail($email);
                header("Location: ../views/home.php");
                exit();
            } else {
                header("Location: ../views/login.php?error=1");
                exit();
            }
        } else {
            header("Location: ../views/login.php");
            exit();
        }
    }

    public function __destruct() {
        $this->user->close();
    }
}

$authController = new AuthController();
$authController->login();
?>
