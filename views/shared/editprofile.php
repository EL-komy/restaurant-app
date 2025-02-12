<?php
require_once "../../controllers/CustomerController.php";
session_start();


if (!isset($_SESSION['email'])) {
    header("Location: signup.php");
    exit();
}

$email = $_SESSION['email'];
// var_dump($email);
$customer = new CustomerController();
$user = $customer->getUserByEmail($email);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    move_uploaded_file($_FILES['picture']['tmp_name'], '../../public/images' . $_FILES['picture']['name']);
    $name = $_POST['user_name'];
    $password = $_POST['passwordd'];
    $address = $_POST['addresss'];
    $phone = $_POST['phone'];
    $photo= $_FILES['picture']['name'];

    var_dump($photo);

    // تحديث البيانات مع التعامل مع كلمة المرور الفارغة
    $customer->updateUser($name, $email, !empty($password) ? $password : null, $address, $phone,$photo);
    
    // header("Location: userinfo.php");
    // exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            padding: 20px;
        }
        .profile-container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2 class="text-center">Edit your Profile</h2>
        <form method="POST">
            <div class="d-flex align-items-center mb-3">
                <img src="logo2.jpg" alt="Profile Picture" class="profile-picture me-3">
                <input type="file" class="btn btn-danger" name="picture">
            </div>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="user_name" 
                       value="<?php echo htmlspecialchars($user['user_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" 
                value="<?php echo htmlspecialchars($user['email']); ?>"  readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">New Password (leave empty to keep current)</label>
                <input type="password" class="form-control" name="passwordd" placeholder="Enter new password">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" 
                       value="<?php echo htmlspecialchars($user['phone']); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" name="addresss" 
                       value="<?php echo htmlspecialchars($user['addresss']); ?>">
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-danger">Save</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>