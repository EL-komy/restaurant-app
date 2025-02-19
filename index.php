<?php
    session_start();
    $userId = isset($_SESSION['email']) ? $_SESSION['email'] : null;
    // var_dump($userId) ;
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fryco</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script>
        function toggleRadioButtons(toggleCheckbox, radioGroupid) {
            var checkbox = document.getElementById(toggleCheckbox);
            var radioGroup = document.getElementById(radioGroupid);
            if (checkbox.checked) {
                radioGroup.style.display = "block";
            } else {
                radioGroup.style.display = "none";
            }
        }
    </script>
    <style>
        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
            padding: 8px 20px;
        }

        .navbar-brand img {
            width: 80px;
            height: 80px;
        }

        .navbar-nav .nav-item .btn {
            color: #808080;
            padding: 6px 14px;
            font-size: 14px;
            border-radius: 20px;
            margin-right: 12px;
            border: 2px solid transparent;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }

        .navbar-nav .nav-item .btn:hover {
            background-color: #f1f1f1;
            color: #212121;
            border-color: #f9001a;
        }

        .dropdown-menu {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            min-width: 180px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            padding: 6px 14px;
            font-size: 14px;
            cursor: pointer;
            color: #808080;
            transition: background-color 0.3s, color 0.3s;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
            color: #212121;
        }

        .lang-btn {
            color: #808080;
            font-size: 14px;
            padding: 6px 14px;
            background-color: transparent;
            border: 2px solid #f9001a;
            border-radius: 20px;
            cursor: pointer;
            transition: color 0.3s, background-color 0.3s;
        }

        .lang-btn:hover {
            color: #ffffff;
            background-color: #f9001a;
        }

        .cart-icon {
            font-size: 20px;
            color: #f9001a;
            margin-right: 12px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .cart-icon:hover {
            color: #c70012;
        }

        .login-btn {
            background-color: #f9001a;
            color: #ffffff;
            border: solid 2px #ffffff;
            margin: auto 12px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 14px;
            transition: color 0.3s, background-color 0.3s;
        }

        .login-btn:hover {
            color: #f9001a;
            border: 2px solid #f9001a;
            background-color: transparent;
        }

        .navbar-nav .nav-item .btn:focus,
        .navbar-nav .nav-item .btn:active {
            color: #f9001a;
            border-color: #f9001a;
        }

        .title {
            display: inline;
        }

        .sub-titel {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            gap: 70%;
        }

        .ViewAll {
            text-decoration: none;
            color: #007aff;

            font-weight: lighter;
        }

        @media (max-width: 767px) {
            .navbar-nav .nav-item .btn {
                font-size: 13px;
                padding: 6px 12px;
            }

            .lang-btn,
            .login-btn {
                font-size: 13px;
                padding: 6px 12px;
            }

            .cart-icon {
                font-size: 18px;
            }
        }

        .carousel-item {
            max-height: 70vh !important;
        }

        .carousel-caption {
            position: absolute;
            bottom: 5%;
            z-index: 2;
        }

        .circle-container {
            display: flex;
            justify-content: center;
            gap: 5vw;
            margin: 40px 0;
        }

        .circle {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: space-around;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .circle:hover {
            transform: scale(1.2);
        }

        .circle-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-weight: bold;
            font-size: 18px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .circle:hover .overlay {
            opacity: 1;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 40px 0;
            font-size: 14px;
        }

        footer h5 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        footer p {
            margin-bottom: 10px;
        }

        .footer-section {
            margin-bottom: 30px;
        }

        .footer-section a {
            color: #f9001a;
            text-decoration: none;
        }

        .footer-section a:hover {
            text-decoration: underline;
        }

        .footer-section .text-center {
            margin-top: 30px;
        }

        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .card-body {
            padding: 20px;
            background-color: #f9f9f9;
        }

        .card-title {
            font-size: 16px;
            font-weight: bold;
            color: #f9001a;
        }

        .card-text {
            font-size: 14px;
            color: #333;
        }

        @media (max-width: 767px) {
            .card {
                margin-bottom: 10px;
            }

            .footer-section {
                margin-bottom: 20px;
            }

            .navbar-nav .nav-item .btn {
                font-size: 13px;
            }

            .carousel-item img {
                height: 50vh !important;
                object-fit: cover;
            }

            .circle-container {
                flex-direction: column;
                gap: 20px;
            }

            .circle {
                width: 50%;
                height: 35vw;
                margin: 0 auto;
            }
        }

        .card-img-top {
            height: 20vw !important;
        }

        .customize-container {
            border-radius: 12px;
            padding: 25px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            background-color: #ffffff;
            border-right: 2px solid #ddd;
            padding: 20px;
            border-radius: 10px;
        }

        .sidebar a {
            text-decoration: none;
            font-size: 1rem;
            color: #6c757d;
            display: block;
            padding: 12px 10px;
            transition: all 0.3s ease;
            border-radius: 5px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #d62a2a;
            color: white;
            font-weight: bold;
        }

        .form-check {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .form-check:hover {
            background-color: #e9ecef;
        }

        .form-check-input:checked+.form-check-label {
            font-weight: bold;
            color: #d62a2a;
        }

        .selected-item {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            padding: 20px;
            text-align: center;
        }

        .selected-item img {
            border-radius: 10px;
            max-width: 80%;
        }

        .btn-add-to-cart {
            background-color: #d62a2a;
            color: white;
            border: none;
            font-size: 18px;
            padding: 12px;
            border-radius: 8px;
            transition: 0.3s ease;
        }

        .btn-add-to-cart:hover {
            background-color: #b22424;
        }

        .btn-reset {
            background-color: #6c757d;
            color: white;
            border-radius: 5px;
            transition: 0.3s ease;
        }

        .btn-reset:hover {
            background-color: #5a6268;
        }

        #photo-one {
            height: 80px;
            width: 120px;
            object-fit: cover;
            border-radius: 5px;
        }

        #tomato-img {
            height: 50px;
            width: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        .modal-dialog {
            max-width: 1100px;
        }

        .modal-content {
            max-height: 80vh;
            overflow-y: auto;
        }

        #meal-btn {
            display: block;
            margin: 5px auto;
            width: 300px;
            border-radius: 24px;
            height: 40px;
            font-weight: bold;
        }

        #meal-btn:hover {
            width: 400px;
            height: 50px;
            transition: 1s;
            background-color: white;
            color: black;
        }
    </style>
</head>

<body>
    <!-- nav -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="./public/images/logo2.jpg" alt="Logo">
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
                <?php if (isset($_SESSION['email'])): ?>
                <a href="config\logout.php" class="btn btn-danger">Log Out</a>
            <?php else: ?>
                <a href=".\views\shared\login.php" class="btn btn-danger">Log In</a>
            <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- slider -->
    <header>
        <div id="carouselExample" class="carousel slide mt-2" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./public/images/12.jpg" class="d-block w-100" alt="Image 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Welcome to Fryco & Grill</h5>
                        <p>Delicious fried and grilled chicken just for you!</p>
                        <a href="#" class="btn btn-light">View Menu</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./public/images/2.jpg" class="d-block w-100" alt="Image 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Welcome to Fryco & Grill</h5>
                        <p>Delicious fried and grilled chicken just for you!</p>
                        <a href="#" class="btn btn-outline-light">View Menu</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./public/images/desktop_thumbnail_27e08e66-1f58-4b6a-bafa-70caadd054ec.jpg" class="d-block w-100" alt="Image 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Welcome to Fryco & Grill</h5>
                        <p>Delicious fried and grilled chicken just for you!</p>
                        <a href="#" class="btn btn-outline-light">View Menu</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </header>
    <div class="sub-titel mt-4">
        <div>
            <h5 class="title">Explore Menu </h5>
            <img src="./public/images/explore-menu-950b8776.png" alt="" width="25" style="position: relative;bottom: 1vh;">

        </div>
        <div>
            <a href="#" class="ViewAll">
                <h6>View All <i class="bi bi-arrow-right-square"></i></h6>
            </a>
        </div>
    </div>

    <!-- circles -->
    <div class="circle-container">
        <div class="circle">
            <img src="./public/images/images.jpeg" class="circle-img" alt="Burger">
            <div class="overlay">Burger</div>
        </div>
        <div class="circle">
            <img src="./public/images/five-star.avif" class="circle-img" alt="Pizza">
            <div class="overlay">Pizza</div>
        </div>
        <div class="circle">
            <img src="./public/images/fried.webp" class="circle-img" alt="Fries">
            <div class="overlay">Fries</div>
        </div>


        <div class="circle">
            <img src="./public/images/drinks.jpg" class="circle-img" alt="Drinks">
            <div class="overlay">Drinks</div>
        </div>

        <div class="circle">
            <img src="./public/images/oporto-family-burger-meal.jpg" class="circle-img" alt="Drinks">
            <div class="overlay">Drinks</div>
        </div>
        <div class="circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
            </svg>
        </div>

    </div>




    <button id="meal-btn"
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#exampleModal">
        check your meal
    </button>


    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container my-5 customize-container">
                        <h2 class="text-center mb-4 text-danger">Customize Your Meal</h2>
                        <div class="row">
                            <!-- Sidebar -->
                            <div class="col-lg-3 sidebar">
                                <a href="#sandwich-section" class="active">Select Your Favorite Sandwich</a>
                                <a href="#side-item-section">Select Your Favorite Side Item</a>
                                <a href="#addon-section">Addon</a>
                            </div>

                            <div class="col-lg-5">
                                <div id="sandwich-section" class="mb-5">
                                    <h5 class="text-danger">Select Your Favorite Sandwich</h5>
                                    <div class="form-check my-2">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="sandwich"
                                            id="spicy-sandwich"
                                            checked />
                                        <label class="form-check-label" for="spicy-sandwich">
                                            <img
                                                id="photo-one"
                                                src="./public/images/images.jpg"
                                                alt="Spicy Sandwich" />
                                            KFC Hamburger Cheeseburger
                                        </label>
                                    </div>
                                    <div class="form-check my-2">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="sandwich"
                                            id="original-sandwich" />
                                        <label class="form-check-label" for="original-sandwich">
                                            <img
                                                id="photo-one"
                                                src="./public/images/images (1).jpg"
                                                alt="Original Sandwich" />
                                            Mighty Zinger
                                        </label>
                                    </div>
                                </div>

                                <div id="side-item-section" class="mb-5">
                                    <h5 class="text-danger">Select Your Favorite Side Item</h5>
                                    <div class="form-check my-2">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="side-item"
                                            id="coleslaw"
                                            checked />
                                        <label class="form-check-label" for="coleslaw">
                                            <img
                                                id="photo-one"
                                                src="./public/images/images (2).jpg"
                                                alt="Coleslaw" />
                                            Coleslaw
                                        </label>
                                    </div>
                                    <div class="form-check my-2">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="side-item"
                                            id="lettuce" />
                                        <label class="form-check-label" for="lettuce">
                                            <img
                                                id="photo-one"
                                                src="./public/images/romaine-lettuce-1296x728-body.webp"
                                                alt="Lettuce" />
                                            Lettuce
                                        </label>
                                    </div>
                                </div>

                                <div id="addon-section" class="mb-5">
                                    <h5 class="text-danger">Drinks</h5>
                                    <div class="form-check my-2">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="addon"
                                            id="mirinda"
                                            checked />
                                        <label class="form-check-label" for="mirinda">
                                            <img
                                                id="photo-one"
                                                src="./public/images/mirinda-orange-can-drink-250ml-nazar-jan-s-supermarket-1_large.webp"
                                                alt="Mirinda" />
                                            Mirinda
                                        </label>
                                    </div>
                                    <div class="form-check my-2">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="addon"
                                            id="coke" />
                                        <label class="form-check-label" for="coke">
                                            <img id="photo-one" src="./public/images/images (3).jpg" alt="Coke" />
                                            Coca Cola
                                        </label>
                                    </div>
                                    <div class="form-check my-2">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="addon"
                                            id="coke" />
                                        <label class="form-check-label" for="coke">
                                            <img id="photo-one" src="./public/images/51DzXSfBFwL.jpg" alt="Coke" />
                                            7 up
                                        </label>
                                    </div>
                                </div>

                                <div class="container mt-3">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                id="toggleCheckbox1"
                                                onclick="toggleRadioButtons('toggleCheckbox1', 'radioGroup1')" />
                                            <img
                                                src="./public/images/Tomato_je.jpg"
                                                alt="صورة"
                                                class="me-2"
                                                width="50" />
                                            <label class="form-check-label" for="toggleCheckbox1">Tomato</label>
                                        </div>
                                    </div>
                                    <div
                                        id="radioGroup1"
                                        style="display: none; margin-top: 10px">
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="options1"
                                                id="option1-1" />
                                            <label class="form-check-label" for="option1-1">Regular</label>
                                        </div>
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="options1"
                                                id="option1-2" />
                                            <label class="form-check-label" for="option1-2">Extra</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="container mt-3">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                id="toggleCheckbox2"
                                                onclick="toggleRadioButtons('toggleCheckbox2', 'radioGroup2')" />
                                            <img
                                                src="./public/images/images (4).jpg"
                                                alt="صورة"
                                                class="me-2"
                                                width="50" />
                                            <label class="form-check-label" for="toggleCheckbox2">American cheese</label>
                                        </div>
                                    </div>
                                    <div
                                        id="radioGroup2"
                                        style="display: none; margin-top: 10px">
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="options2"
                                                id="option2-1" />
                                            <label class="form-check-label" for="option2-1">Regular</label>
                                        </div>
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="options2"
                                                id="option2-2" />
                                            <label class="form-check-label" for="option2-2">Extra</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 selected-item">
                                <img
                                    src="./public/images/Sargento11501.jpg"
                                    class="img-fluid"
                                    alt="Zinger Crunch" />
                                <h4 class="mt-3 text-danger">Zinger Crunch</h4>
                                <p class="text-muted">Zinger + Kantook + Coleslaw</p>
                                <button class="btn btn-reset btn-sm mb-3">RESET</button>
                                <h3 class="text-danger">125.00 EGP</h3>
                                <p class="text-muted">* All prices are VAT inclusive</p>
                                <button class="btn btn-add-to-cart w-100">Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <div class="text">
        <h5>EXCLUSIVE OFFERS </h5>
        <h5>FOR ONE </h5>
        <h5>FOR SHARING </h5>
        <h5>SIDES & DESSERTS </h5>
    </div>



    <!-- cards -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img src="./public/images/five-star.avif" class="card-img-top" alt="Ad 1">
                    <div class="card-body">
                        <h5 class="card-title">Special Offer</h5>
                        <p class="card-text">Get 20% off on all meals!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="./public/images/ai-generative-3d-style-design-of-fried-chicken-in-yellow-background-photo.jpg" class="card-img-top" alt="Ad 2">
                    <div class="card-body">
                        <h5 class="card-title">Combo Deal</h5>
                        <p class="card-text">Buy one, get one free on select items!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="./public/images/oporto-family-burger-meal.jpg" class="card-img-top" alt="Ad 3">
                    <div class="card-body">
                        <h5 class="card-title">New Arrival</h5>
                        <p class="card-text">Try our new spicy chicken wings!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="./public/images/fried.webp" class="card-img-top" alt="Ad 4">
                    <div class="card-body">
                        <h5 class="card-title">Limited Time</h5>
                        <p class="card-text">Get a free drink with every meal!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 footer-section">
                    <h5>About Us</h5>
                    <p>Fryco & Grill is your go-to destination for the most delicious fried and grilled meals. Enjoy the best
                        taste with us!</p>
                </div>
                <div class="col-md-4 footer-section">
                    <h5>Contact Us</h5>
                    <p>Email: contact@fryco.com</p>
                    <p>Phone: +123 456 7890</p>
                    <p>Address: 123 Food Street, Cairo</p>
                </div>
                <div class="col-md-4 footer-section">
                    <h5>Follow Us</h5>
                    <p><a href="#">Facebook</a> | <a href="#">Instagram</a> | <a href="#">Twitter</a></p>
                </div>
            </div>
            <p class="text-center mt-3">&copy; 2025 Fryco & Grill. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function changeLanguage() {
            alert("تم تغيير اللغة إلى العربية");
        }
    </script>
</body>

</html>