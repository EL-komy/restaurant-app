
<?php
require_once '../../controllers/CustomerController.php';
$email=$_SESSION['email'];
if($email){
  $controller= new CustomerController();
  $user=$controller->select(`users`,$email);
}else{
    header("Location:login.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: white;
            color: red;
            text-align: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .profile-picture {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid red;
            margin-bottom: 15px;
        }
        .profile-info {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        .profile-info div {
            margin: 10px 0;
        }
        .profile-info strong {
            color: black;
        }
        .btn-edit {
            background: red;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            transition: 0.3s;
            border: none;
        }
        .btn-edit:hover {
            background: darkred;
        }
    </style>
</head>
<body>
    <img src="logo2.jpg" alt="Profile Picture" class="profile-picture">
    <h2>Jessica Alba</h2>
    
    <div class="profile-info">
        <div><strong>Name:</strong> <?=$user['name']?></div>
        <div><strong>Email:</strong> <?=$user['email']?></div>
        <div><strong>Address:</strong> <?=$user['address']?></div>
        <div><strong>Phone:</strong> <?=$user['phone']?></div>
    </div>
    
    <a href="editprofile.php" class="btn btn-edit">Edit Profile</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
