<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($name, $email, $password, $picture, $address) {
        $query = "INSERT INTO users (user_name, email, passwordd, rolee, profile_picture, addresss) 
                  VALUES (:name, :email, :password, 1, :picture, :address)";
        
        $stmt = $this->conn->prepare($query);
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':picture', $picture);
        $stmt->bindParam(':address', $address);

        return $stmt->execute();
    }

    public function login($email, $password) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['passwordd'])) {
            return $user; 
        }
        return false; 
    }
    public function select($table,$email){
        $selectQuery="SELECT * FROM `$table` WHERE email=$email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($user);
        if($user){
            return $user;
        }else{
            return false;
        }
    }
}
?>
