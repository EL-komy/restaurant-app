<?php 
require_once '../../config/login_valid.php';
require_once '../../controllers/CustomerController.php';

$flag = null;
$email = isset($_POST['email']) ? trim($_POST['email']) : "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($error)) {
    $controller = new CustomerController();
    // var_dump($_POST['email'], $_POST['password']);
    $flag = $controller->login($_POST['email'], $_POST['password']);
    
    if (!$flag) {
        $error["login"] = "Invalid email or password";
    }
}
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
            display: flex;
            justify-content: center; 
            align-items: center;
            overflow: hidden;
            margin: 0;
        }
        .image-container img {
            width: 80%;
            height: 80%;
            object-fit: cover;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
        }
        .btn-primary {
            background-color: rgb(179 38 42);
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
                    <input type="text" name="email" class="form-control" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                    <?php if (!empty($error["email"])): ?>
                        <p class="error-text"><?php $error["email"] ?></p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                    <?php if (!empty($error["password"])): ?>
                        <p class="error-text"> <?= $error["password"] ?> </p>
                    <?php endif; ?>
                </div>
                <?php if (!empty($error["login"])): ?>
                    <p class="error-text text-center"><?= $error["login"] ?></p>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <div class="text-center mt-3">
            <a href="signup.php" class="btn btn-link w-100 ">Create an Account</a>
            </div>
        </div>
        <div class="image-container">
            <img src="../../public/images/12.jpg" alt="">
        </div>
    </div>
</body>
</html>
