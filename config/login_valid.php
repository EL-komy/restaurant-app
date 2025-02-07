<?php
session_start();
$error=[];
$users = [
    "user@example.com" => ["password" => "123456", "name" => "John Doe", "role" => "customer"],
    "admin@example.com" => ["password" => "admin123", "name" => "Admin User", "role" => "staff"]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $email_pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    if (!preg_match($email_pattern, $email)) {
        $error["email"] = "Invalid email format!";
    }

    if (!$password) {
        $error["password"] = "password is required";
    }

    if (isset($users[$email]) && $users[$email]["password"] === $password) {
        $_SESSION["user_id"] = $email;
        $_SESSION["user_name"] = $users[$email]["name"];
        $_SESSION["user_role"] = $users[$email]["role"];
        header("Location: ../../index.php");
        exit();
    }
}


