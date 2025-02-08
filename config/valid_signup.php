<?php
// session_start();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $name = $_POST['user_name'];
        $email = $_POST['email'];
        $password = $_POST['passwordd'];
        $phone = $_POST['phone'];
        $address = $_POST['addresss'];

        $nameRegex = "/^(?=.*[A-Z])[a-zA-Z0-9]{6,}$/";
        $passwordRegex = "/^\d{7,}$/";
        $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $phoneRegex = "/^(010|011|012|015)[0-9]{8}$/";


        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $tempfilename = $_FILES['profile_picture']['tmp_name'];
            $destination = "images/" . $_FILES['profile_picture']['name'];

            if (!move_uploaded_file($tempfilename, $destination)) {
                $errors['file'] = "Failed to upload file.";
            }
        }


        if (!preg_match($nameRegex, $name)) {
            $errors['name'] = "Your name should at least contain 6 characters and one of them should be uppercase.";
        }


        if (!preg_match($passwordRegex, $password)) {
            $errors['password'] = "your password should be more than or equal 7 numbers.";
        }


        if (!preg_match($emailRegex, $email)) {
            $errors['email'] = "Email address is not valid.";
        }


        if (!preg_match($phoneRegex, $phone)) {
            $errors['phone'] = "Phone number is not valid. It should start with 010, 011, 012, or 015 and have 8 digits.";
        }


        if (empty($errors)) {
            // $_SESSION['user_name'] = $name;

            // header("Location: index.php");
            // exit();
        }
    }
}
