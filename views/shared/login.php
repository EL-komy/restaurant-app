<?php 
require_once '../../config/login_valid.php';
require_once '../../controllers/CustomerController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $controller = new CustomerController();
    $controller->login($email, $password);
}
?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(242, 233, 233);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            display: flex;
            width: 800px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .form-container {
            width: 50%;
            padding: 10px;
        }
        .image-container {
            width: 50%;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background: url('../../public/images/ai-generative-3d-style-design-of-fried-chicken-in-yellow-background-photo.jpg') center/cover;
        }
        .btn-primary {
            background-color: rgb(159, 39, 39);
            border-color: rgb(159, 39, 39);
        }
        .btn-primary:hover {
            background-color: darkred;
            border-color: darkred;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center">Login</h2>
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" >
                    <?php 
                    if (!empty($error["email"])) {
                        echo '<p style="color:red; font-size:12px;">' . $error["email"] . '</p>';
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" >
                    <?php 
                    if (!empty($error["password"])) {
                        echo '<p style="color:red; font-size:12px;">' . $error["password"] . '</p>';
                    }
                    ?>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
        <div class="image-container"></div>
    </div>
</body>
</html>
