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

    public function register($name, $email, $password , $picture,$add) {
        $result=$this->user->register($name, $email, $password, $picture,$add);
        if(!$result){
            echo "Registration failed!";
        }
        else{
            header('Location: ../../index.php');
        }
    }

    public function updateMenuItem($itemId, $newPrice) {
        // Logic to update menu item price
        echo "Updated menu item $itemId with new price $newPrice";
    }
}

