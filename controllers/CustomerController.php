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

    // public function updateMenuItem($itemId, $newPrice) {
    //     // Logic to update menu item price
    //     echo "Updated menu item $itemId with new price $newPrice";
    // }
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../../pages/login.php");
        exit();
    }
    

    public function updateMenuItem($itemId, $newPrice) {
        // Logic to update menu item price
        echo "Updated menu item $itemId with new price $newPrice";
    }

    public function login($email, $password) {
        $user = $this->user->login($email, $password);
        if ($user) {
            session_start();
            // $_SESSION['user_id'] = $user['id'];
            // $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['email'] = $email;

            // echo "Login successful! Welcome, " . $_SESSION['user_name'];
            header('Location: ../../index.php'); 
        } else {
            return false;
        }
    }

    public function changeRole($id, $role) {
        $this->user->updateRole($id, $role);
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
    public function getUserByEmail($email) {
        $sql = "SELECT user_name, email, addresss, phone ,profile_picture FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($name, $email, $password, $address, $phone,$photo) {
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE users SET user_name = :name, passwordd = :password, addresss = :address, phone = :phone , profile_picture = :photo  
            WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashed_password,
                ':address' => $address,
                ':phone' => $phone,
                ':photo' => $photo
            ]);
        } else {
            $sql = "UPDATE users SET user_name = :name, addresss = :address, phone = :phone , profile_picture = :photo
             WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':address' => $address,
                ':phone' => $phone,
                ':photo' => $photo
            ]);
        }
    }
    // public function select(){
    //     $user = $this->user->select($table,$email);
    //     if($user){
    //         // session_ start();

    //     }
    // }
    // public function selectAll(){
       
    //     $user = $this->user->selectAll();
    //     return $user;
    // }

    // public function delete($id){       
    //      $this->user->delete($id);
    // }

}
