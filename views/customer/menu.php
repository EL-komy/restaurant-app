<?php
require_once '../../controllers/MenuController.php';


// جلب العناصر من جدول قائمة الطعام
$sql = "SELECT name, description, price, image FROM menu_items";
$result = $conn->query($sql);

// تخزين العناصر في مصفوفة لتكون جاهزة للطباعة في HTML
$menuItems = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menuItems[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/index.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../public/images/logo2.jpg" alt="Logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="../../index.php">Home</a>
                    </li>
                </ul>
                <button class="lang-btn">Sign Up</button>
                <button class="login-btn">Log In</button>
            </div>
        </div>
    </nav>

    <!-- Menu Section -->
    <div class="container my-5">
        <h2 class="text-center text-danger fw-bold">Restaurant Menu</h2>
        <div class="row g-4 mt-4" id="menu-items">
            <?php if (count($menuItems) > 0): ?>
                <?php foreach ($menuItems as $item): ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="<?= $item['image'] ?>" class="card-img-top" alt="Food" onerror="this.src='../../public/images/default-food.jpg'">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $item['name'] ?></h5>
                                <p class="text-danger fw-bold">$<?= number_format($item['price'], 2) ?></p>
                                <p class="card-text"><?= $item['description'] ?></p>
                                <button class="btn btn-danger w-100">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-muted">No menu items available.</p>
            <?php endif; ?>
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
