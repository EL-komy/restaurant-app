
<?php
require_once "../../controllers/CustomerController.php";
session_start();
$email=$_SESSION['email'];
// var_dump($email);       
if($email){
  $controller= new CustomerController();
    
  $user=$controller->select($email);
  

//   var_dump($user);
}else{
    header("Location:./login.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/nav.css">
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
<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../public/images/logo2.jpg" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="#"> <i class="bi bi-check-lg"></i> Delivery</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="#">Self-Pickup</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="#">Dine-In</a>
                    </li>
                    <li class="nav-item location-select dropdown">
                        <a class="btn btn-outline-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Choose Location
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">City 1</a></li>
                            <li><a class="dropdown-item" href="#">City 2</a></li>
                            <li><a class="dropdown-item" href="#">City 3</a></li>
                            <li><a class="dropdown-item" href="#">City 4</a></li>
                        </ul>
                    </li>
                </ul>
                <i class="bi bi-cart cart-icon"></i>
                <button class="lang-btn" onclick="changeLanguage()">العربية</button>
                <img src="../../public/images/2.jpg" class="img-fluid rounded mx-3" alt="Rounded Image" width="100px">

            </div>
        </div>
    </nav>
    <img src="logo2.jpg" alt="Profile Picture" class="profile-picture">
    <h2><?=$user['user_name']?></h2>
    
    <div class="profile-info">
<<<<<<< HEAD
        <div><strong>Name:</strong> <?=$user['user_name']?></div>
        <div><strong>Email:</strong> <?=$user['email']?></div>
        <div><strong>Address:</strong> <?=$user['addresss']?></div>
=======
        <div><strong>Name:</strong> <?=$user['name']?></div>
        <div><strong>Email:</strong> <?=$user['email']?></div>
        <div><strong>Address:</strong> <?=$user['address']?></div>
>>>>>>> 418de30 (showing user info)
        <div><strong>Phone:</strong> <?=$user['phone']?></div>
    </div>
    
    <a href="editprofile.php" class="btn btn-edit">Edit Profile</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
