<?php


require_once "../../config/valid_signup.php";
require_once "../../controllers/CustomerController.php";
if (isset($_POST['submit'])) {
    if (empty($errors)) {
        $customer = new CustomerController();
        $customer->register($name, $email, $password, $picture, $address);
        $_SESSION['user_name'] = $name;
        header("Location: ../../index.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
            background: url('../../public/images/fryco.jpg') center/cover;
        }

        .btn-primary {
            background-color: rgb(159, 39, 39);
            border-color: rgb(159, 39, 39);
        }

        .btn-primary:hover {
            background-color: darkred;
            border-color: darkred;
        }

        .error {
            font-weight: bold;
            color: red;
            margin-top: 5px;
        }

        .error {
            font-weight: bold;
            color: red;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .text-center {
            margin-top: 300px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center">Sign Up</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="user_name" class="form-control" value="<?php echo isset($name) ? $name : ''; ?>">
                    <?php if (isset($errors['name'])) { ?>
                        <p class="error"><?php echo $errors['name']; ?></p>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo isset($email) ? $email : ''; ?>">
                    <?php if (isset($errors['email'])) { ?>
                        <p class="error"><?php echo $errors['email']; ?></p>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="passwordd" class="form-control" value="<?php echo isset($password) ? $password : ''; ?>">
                    <?php if (isset($errors['password'])) { ?>
                        <p class="error"><?php echo $errors['password']; ?></p>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="tel" name="phone" class="form-control" value="<?php echo isset($phone) ? $phone : ''; ?>">
                    <?php if (isset($errors['phone'])) { ?>
                        <p class="error"><?php echo $errors['phone']; ?></p>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Profile Picture</label>
                    <input type="file" name="profile_picture" class="form-control">
                    <?php if (isset($errors['file'])) { ?>
                        <p class="error"><?php echo $errors['file']; ?></p>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="addresss" class="form-control" value="<?php echo isset($address) ? $address : ''; ?>">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="checkboxx" class="form-check-input">
                    <label class="form-check-label">I agree to the Privacy Policy</label>
                </div>
                <button type="submit" name="submit" class="btn btn-primary w-100">Sign Up</button>
            </form>
        </div>
        <div class="image-container"></div>
    </div>
</body>

</html>