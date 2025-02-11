<?php

class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register($name, $email, $password, $picture, $address, $phone)
    {
        $query = "INSERT INTO users (user_name, email, passwordd, rolee, profile_picture, addresss,phone) 
                  VALUES (:name, :email, :password, 1, :picture, :address,:phone)";

        $stmt = $this->conn->prepare($query);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':picture', $picture);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);


        return $stmt->execute();
    }

    public function login($email, $password)
    {
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
    public function select($email)
    {
        // $selectQuery="SELECT * FROM `users` WHERE email=$email";
        // $stmt = $this->conn->prepare($query);
        // $stmt->execute();
        // var_export($email);
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($user);

        if ($user) {
            return $user;
        } else {
            return false;
        }
    }

    public function selectAll()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
        
    // public function select($table,$email){
    //     $selectQuery="SELECT * FROM `$table` WHERE email=$email";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();
    //     $user = $stmt->fetch(PDO::FETCH_ASSOC);
    //     var_dump($user);
    //     if($user){
    //         return $user;
    //     }else{
    //         return false;
    //     }
    // }




    public function getUserByEmail($email) {
        $sql = "SELECT name, email, address, phone FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    public function updateUser($name, $email, $password, $address, $phone) {
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE users SET name = :name, password = :password, address = :address, phone = :phone WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashed_password,
                ':address' => $address,
                ':phone' => $phone
            ]);
        } else {
            $sql = "UPDATE users SET name = :name, address = :address, phone = :phone WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':address' => $address,
                ':phone' => $phone
            ]);
        }
        return $stmt->rowCount() > 0; 
    }
}
