<?php
require_once '../../models/User.php';
require_once '../../config/db.php';

class CustomerController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->user = new User($this->db);
    }

    public function register($name, $email, $password, $picture, $add) {
        $result = $this->user->register($name, $email, $password, $picture, $add);
        if (!$result) {
            echo "Registration failed!";
        } else {
            // header('Location: ../../index.php');
        }
    }

    public function updateMenuItem($itemId, $newPrice) {
        echo "Updated menu item $itemId with new price $newPrice";
    }

    public function login($email, $password) {
        $user = $this->user->login($email, $password);
        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['email'] = $user['email'];

            header('Location: ../../index.php');
            exit();
        } else {
            return false;
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../../pages/login.php");
        exit();
    }
}
