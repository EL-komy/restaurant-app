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
        $user=$this->user->register($name, $email, $password, $picture,$add);
        if(!$user){
            echo "Registration failed!";
        }
        else{
            $_SESSION['email'] = $email;
        }
    }

    public function updateMenuItem($itemId, $newPrice) {
        // Logic to update menu item price
        echo "Updated menu item $itemId with new price $newPrice";
    }

    public function login($email, $password) {
        $user = $this->user->login($email, $password);
        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['email'] = $user['email'];

            echo "Login successful! Welcome, " . $_SESSION['user_name'];
            // header('Location: ../../index.php'); 
        } else {
            echo "Invalid email or password!";
        }
    }

    public function getUserByEmail($email) {
        $user = $this->user->getUserByEmail($email);
        if ($user) {
            echo "User found: ";
            print_r($user);
        } else {
            echo "User not found!";
        }
    }

    public function updateUser($name, $email, $password, $address, $phone) {
        $updated = $this->user->updateUser($name, $email, $password, $address, $phone);
        if ($updated) {
            echo "User updated successfully!";
        } else {
            echo "No changes made or update failed!";
        }
    }
    public function select(){
        $user = $this->user->select($table,$email);
        if($user){
            // session_ start();

        }
    }

}
