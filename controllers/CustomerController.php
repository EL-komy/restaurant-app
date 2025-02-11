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

    public function register($name, $email, $password , $picture,$add,$phone) {
        $user=$this->user->register($name, $email, $password, $picture,$add,$phone);

        if(!$user){
            echo "Registration failed!";
        }
        else{
            session_start();
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
    public function select($email){
       
        $user = $this->user->select($email);
        return $user;
    }

    public function selectAll(){
       
        $user = $this->user->selectAll();
        return $user;
    }

    public function delete($id){       
         $this->user->delete($id);
    }

}
