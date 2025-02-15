<?php
session_start();
$error = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $email_pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    if (!preg_match($email_pattern, $email)) {
        $error["email"] = "Invalid email format!";
    }

    if (!$password) {
        $error["password"] = "Password is required";
    }
}
?>
