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
    <link rel="stylesheet" href="public/css/index.css">
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
                        <a class="btn btn-outline-light" href="index.php"> <i class="bi bi-check-lg"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="views/customer/menu.php">Menu</a>
                    </li>
                   </ul>
                <i class="bi bi-cart cart-icon"></i>
                <?php if (isset($_SESSION['email'])): ?>
                <a href="config\logout.php" class="btn btn-danger">Log Out</a>
            <?php else: ?>
                <a href=".\views\shared\login.php" class="btn btn-danger">Log In</a>
            <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- slider -->
     <div class="container">
    <header>
    <div id="carouselExampleIndicators" class="carousel slide mt-5">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./public/images/cover4.jpg" class="d-block w-100" alt="..." height="300vh">
      <div class="carousel-caption d-none d-md-block" id="txt" style="text-align: start;margin-bottom:7%;">
                        <h5>Welcome to Fryco & Grill</h5>
                        <p>Delicious fried and grilled chicken just for you!</p>
                        <a href="views/customer/menu.php" class="btn btn-light">View Menu</a>
                    </div>
    </div>

    <div class="carousel-item">
      <img src="./public/images/cover5.jpg" class="d-block w-100" alt="..."  height="300vh">
    </div>
    <div class="carousel-item">
      <img src="./public/images/COVER7.jpg" class="d-block w-100" alt="..." height="300vh">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    </header>

    <div class="sub-titel mt-5">
        <div>
            <h5 class="title">Explore Menu </h5>
            <img src="./public/images/explore-menu-950b8776.png" alt="" width="25" style="position: relative;bottom: 1vh;">

        </div>
        <div>
            <a href="views/customer/menu.php" class="ViewAll">
                <h6>View All <i class="bi bi-arrow-right-square"></i></h6>
            </a>
        </div>
    </div>

    <!-- circles -->
    <div class="circle-container mt-5">
        <div class="circle">
            <img src="./public/images/burger1.jpg" class="circle-img" alt="Burger">
            <div class="overlay">Burger</div>
        </div>
        <div class="circle">
            <img src="./public/images/pizza.jpeg" class="circle-img" alt="Pizza">
            <div class="overlay">Pizza</div>
        </div>
        <div class="circle">
            <img src="./public/images/orange-box-french-fries-with-red-box-that-says-french-fries_899894-19860.avif" class="circle-img" alt="Fries">
            <div class="overlay">Fries</div>
        </div>



        <div class="circle">
            <img src="./public/images/drinks.jpg" class="circle-img" alt="Drinks">
            <div class="overlay">Drinks</div>
        </div>


        <div class="circle">
            <svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
            </svg>
        </div>

    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <!-- Menu Card -->
            <div class="col-md-5 mb-3">
                <div class="card custom-card">
                    <img src="https://b1435806.smushcdn.com/1435806/wp-content/uploads/2018/01/menu.png?lossy=1&strip=1&webp=1" class="card-img-top" alt="Menu">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">View Menu</h5>
                        <a href="views/customer/menu.php" class="btn btn-danger btn-lg w-100">Explore</a>
                    </div>
                </div>
            </div>

            <!-- Reservation Card -->
            <div class="col-md-5 mb-3">
                <div class="card custom-card">
                    <img src="https://gritsandgrids.s3.amazonaws.com/media/2017/02/Shade-Burger-YOD-studio-11.jpg" class="card-img-top" alt="Reserve">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Reserve a Table</h5>
                        <a href="./views/shared/reservation.php" class="btn btn-dark btn-lg w-100">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- <button id="meal-btn"
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#exampleModal">
        check your meal
    </button> -->


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
<div class="txt-con">
    <div class="text">
        <h5>EXCLUSIVE OFFERS </h5>
        <h5>FOR ONE </h5>
        <h5>FOR SHARING </h5>
        <h5>SIDES & DESSERTS </h5>
    </div>

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


const items = document.querySelectorAll(".text h5");

items.forEach((item, index) => {
    setTimeout(() => {
        item.style.opacity = "1";
        item.style.transform = "translateY(0)";
    }, index * 700); 
});




document.querySelectorAll('.circle').forEach((circle) => {
    circle.onclick = function () {
      window.location.href = 'views/customer/menu.php';
    };
  });
    </script>
</body>

</html>