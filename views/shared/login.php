<?php 
require_once '../../config/login_valid.php';
require_once '../../controllers/CustomerController.php';

$flag = null;
$email = isset($_POST['email']) ? trim($_POST['email']) : "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($error)) {
    $controller = new CustomerController();
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
            padding: 20px;
        }
        .image-container {
            width: 50%;
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
        .error-text {
            color: red;
            font-size: 12px;
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
                    <input type="text" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>">
                    <?php if (!empty($error["email"])): ?>
                        <p class="error-text"><?= $error["email"] ?></p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                    <?php if (!empty($error["password"])): ?>
                        <p class="error-text"><?= $error["password"] ?></p>
                    <?php endif; ?>
                </div>
                <?php if (!empty($error["login"])): ?>
                    <p class="error-text text-center"><?= $error["login"] ?></p>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
        <div class="image-container"></div>
    </div>
</body>
</html>
