<?php
session_start(); // بدء الجلسة لتمكين تخزين السلة
require_once '../../controllers/MenuController.php';

$controller = new MenuController();
$menuItems = $controller->select();

// إضافة المنتج إلى السلة عند الضغط
if (isset($_GET['add_to_cart'])) {
    $itemId = $_GET['add_to_cart'];
    
    // البحث عن المنتج باستخدام id
    foreach ($menuItems as $categoryName => $items) {
        foreach ($items as $item) {
            if ($item['item_id'] == $itemId) {
                // إذا كان المنتج موجود في السلة، نقوم بزيادة الكمية
                if (isset($_SESSION['cart'][$itemId])) {
                    $_SESSION['cart'][$itemId]['quantity']++;
                } else {
                    // إضافة المنتج إلى السلة
                    $_SESSION['cart'][$itemId] = [
                        'id' => $item['item_id'],
                        'name' => $item['item_name'],
                        'price' => $item['price'],
                        'image' => $item['image'],
                        'description' => $item['description'],
                        'quantity' => 1
                    ];
                }
                break 2;
            }
        }
    }
    
    // إعادة توجيه المستخدم إلى صفحة السلة بعد إضافة المنتج
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Menu</title>
<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
=======

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background-color: #fff;
            scroll-behavior: smooth;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #701515;
            /* Red navbar */
        }

        .navbar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: white;
            font-size: 1rem;
            transition: 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #ffccbc;
            /* Lighter red */
        }

        /* Card Styling */
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card-img-top {
            height: 200px;
            /* Adjust as needed */
            object-fit: cover;
        }

        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }


        .card:hover {
            transform: scale(1.05);
        }

        .card-title {
            color: #d32f2f;
            /* Red color */
            font-weight: bold;
        }

        .btn-add-cart {
            background-color: #d32f2f;
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-add-cart:hover {
            background-color: #881212;
        }

        /* Footer Styling */
        .footer {
            background-color: #701515;
            color: white;
            padding: 20px 0;
        }

        .footer a {
            color: white;
            margin: 0 10px;
            font-size: 20px;
        }

        .footer a:hover {
            color: #ffccbc;
        }
    </style>
>>>>>>> main
</head>

<body>
    <!-- Navbar -->
<<<<<<< HEAD
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../public/images/logo2.jpg" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
=======
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container ">
            <a class="navbar-brand justify-content-start" href="#">FRYCO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
>>>>>>> main
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="btn btn-outline-light" href="../../index.php">Home</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light" href="#">Profile</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light" href="#">Menu</a></li>
                </ul>
                <a href="cart.php"> <i class="bi bi-cart cart-icon"></i><a>
                <button class="lang-btn">Sign Up</button>
                <button class="login-btn">Log In</button>
            </div>
        </div>
    </nav>

<<<<<<< HEAD
    <!-- Menu Section -->
    <div class="container my-5">
        <h2 class="text-center text-danger fw-bold">Restaurant Menu</h2>
        <div class="row g-4 mt-4" id="menu-items">
            <?php if (count($menuItems) > 0): ?>
                <?php foreach ($menuItems as $categoryName => $items): ?>
                    <h3 class="text-center text-primary"><?= $categoryName ?></h3>
                    <?php foreach ($items as $item): ?>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="<?= !empty($item['image']) ? '../../public/images/' . $item['image'] : 'default.jpg' ?>" class="card-img-top" alt="Food">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= $item['item_name'] ?></h5>
                                    <p class="text-danger fw-bold">$<?= number_format($item['price'], 2) ?></p>
                                    <p class="card-text"><?= $item['description'] ?></p>
                                    <!-- هنا نقوم بإضافة الرابط لزر "Add to Cart" والذي يرسل مع الـ GET id المنتج -->
                                    <a href="menu.php?add_to_cart=<?= $item['item_id'] ?>" class="btn btn-danger w-100">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-muted">No menu items available.</p>
            <?php endif; ?>
=======
    <div style="margin-top: 70px;"></div>

    <div class="container my-5">
        <h2 class="text-center text-danger fw-bold">FRYCO Menu</h2>
        <div class="row g-4 mt-4">
            <?php foreach ($cat as $item): ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="../../public/images/<?= $item['image'] ?>" class="card-img-top" alt="Sandwich">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $item['name'] ?></h5>
                            <p class="text-danger fw-bold"><?= $item['price'] ?></p>
                            <p class="card-text"><?= $item['description'] ?></p>
                            <form action="" method="POST">
                                <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                                <input type="hidden" name="item_name" value="<?= $item['name'] ?>">
                                <input type="hidden" name="item_price" value="<?= $item['price'] ?>">
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- <div class="col-md-4">
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
            </div> -->

>>>>>>> main
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>