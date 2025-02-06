<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($name,$email,$password,$picture,$address) {
        $query = "INSERT INTO users (user_name, email, passwordd, rolee, profile_picture ,addresss) VALUES (:name, :email, :password, 1,:picture ,:address)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        // $stmt->bindParam(':role', 1);
        $stmt->bindParam(':picture', $picture);
        $stmt->bindParam(':address', $address);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}