<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Menu</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/index.css">
    <style>
       
     </style>
</head>
<body>

    <!-- Navbar -->
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
                        <a class="btn btn-outline-light" href="#"> <i class="bi bi-check-lg"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="#">Menu</a>
                    </li>
                   </ul>
                <i class="bi bi-cart cart-icon"></i>
                <button class="lang-btn" >sign up</button>
                <button class="login-btn">Log In</button>
            </div>
        </div>
    </nav>
 
    <!-- Spacing after fixed navbar -->
    <div style="margin-top: 70px;"></div>

    <!-- Menu Section -->
    <div class="container my-5">
        <h2 class="text-center text-danger fw-bold">FRYCO Menu</h2>
        <div class="row g-4 mt-4">
            
            <!-- Sandwich Card 1 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="pexels-photo-12325045.webp" class="card-img-top" alt="Sandwich">
                    <div class="card-body text-center">
                        <h5 class="card-title">Chicken Sandwich</h5>
                        <p class="text-danger fw-bold">$5.99</p>
                        <p class="card-text">A delicious grilled chicken sandwich with fresh lettuce and sauce.</p>
                       <button class="btn btn-danger w-100">
                      <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                    </div>
                </div>
            </div>

            <!-- Sandwich Card 2 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="pexels-photo-1600727.jpeg" class="card-img-top" alt="Sandwich">
                    <div class="card-body text-center">
                        <h5 class="card-title">Beef Burger</h5>
                        <p class="text-danger fw-bold">$7.49</p>
                        <p class="card-text">Juicy beef burger with cheese, tomato, and special sauce.</p>
                       <button class="btn btn-danger w-100">
                      <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                    </div>
                </div>
            </div>

            <!-- Sandwich Card 3 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="pexels-photo-1639565.webp" class="card-img-top" alt="Sandwich">
                    <div class="card-body text-center">
                        <h5 class="card-title">Veggie Delight</h5>
                        <p class="text-danger fw-bold">$4.99</p>
                        <p class="card-text">Fresh vegetables with a tangy dressing on whole grain bread.</p>
                       <button class="btn btn-danger w-100">
                      <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                    </div>
                </div>
            </div>

        </div>
        <div class="row g-4 mt-4">
            
            <!-- Sandwich Card 1 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="pexels-photo-1893558.jpeg" class="card-img-top" alt="Sandwich">
                    <div class="card-body text-center">
                        <h5 class="card-title">Chicken Sandwich</h5>
                        <p class="text-danger fw-bold">$5.99</p>
                        <p class="card-text">A delicious grilled chicken sandwich with fresh lettuce and sauce.</p>
                       <button class="btn btn-danger w-100">
                      <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                    </div>
                </div>
            </div>

            <!-- Sandwich Card 2 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="pexels-photo-5474626.jpeg" class="card-img-top" alt="Sandwich">
                    <div class="card-body text-center">
                        <h5 class="card-title">Beef Burger</h5>
                        <p class="text-danger fw-bold">$7.49</p>
                        <p class="card-text">Juicy beef burger with cheese, tomato, and special sauce.</p>
                       <button class="btn btn-danger w-100">
                      <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                    </div>
                </div>
            </div>

            <!-- Sandwich Card 3 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="pexels-photo-5474836.jpeg" class="card-img-top" alt="Sandwich">
                    <div class="card-body text-center">
                        <h5 class="card-title">Veggie Delight</h5>
                        <p class="text-danger fw-bold">$4.99</p>
                        <p class="card-text">Fresh vegetables with a tangy dressing on whole grain bread.</p>
                       <button class="btn btn-danger w-100">
                      <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer id="contact" class="footer text-center">
        <div class="container">
            <h5>Contact Us</h5>
            <p>Email: info@myrestaurant.com | Phone: +123 456 7890</p>
            <div>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
