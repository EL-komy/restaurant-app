<?php
session_start();

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Handle removing an item from the cart
if (isset($_GET['remove_from_cart'])) {
    $itemId = $_GET['remove_from_cart'];
    unset($_SESSION['cart'][$itemId]);



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['cart_options'] = [
            'cheese' => $_POST['cheese'],
            'tomato' => $_POST['tomato'],
            'drink' => $_POST['drink']
        ];
    }

    header("Location: cart.php");
    exit();
    // huuuhuuuuuuuuuuu
}

// Handle updating the quantity of an item
if (isset($_POST['update_quantity'])) {
    $itemId = $_POST['item_id'];
    $newQuantity = (int)$_POST['quantity'];

    if ($newQuantity > 0) {
        $_SESSION['cart'][$itemId]['quantity'] = $newQuantity;
    } else {
        unset($_SESSION['cart'][$itemId]); // Remove item if quantity is 0
    }
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/public/css/index.css"> <!-- Corrected path -->
    <style>
        .quantity-btn {
            cursor: pointer;
            user-select: none;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="/public/images/logo2.jpg" alt="Logo" style="height: 40px;" rounded> <!-- Corrected path -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8080/views/shared/userinfo.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menu.php">Menu</a>
                    </li>
                </ul>
                <!-- Cart Icon with Dynamic Count -->
                <a href="cart.php" class="btn btn-outline-light position-relative">
                    <i class="fas fa-shopping-cart" style="color: red;"></i> <!-- Red cart icon -->
                    <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?= array_sum(array_column($cart, 'quantity')) ?>
                    </span>
                </a>

                <?php if (isset($_SESSION['email'])): ?>
                    <a href="config/logout.php" class="btn btn-danger">Log Out</a>
                <?php else: ?>
                    <a href="./views/shared/login.php" class="btn btn-danger">Log In</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Cart Section -->
    <div class="container my-5">
        <h2 class="text-center text-danger fw-bold">Your Cart</h2>
        <div class="row">
            <?php if (count($cart) > 0): ?>
                <?php foreach ($cart as $itemId => $item): ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="/public/images/<?= $item['image'] ?>" class="card-img-top" alt="Food"> <!-- Corrected path -->
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $item['name'] ?></h5>
                                <p class="text-danger fw-bold">$<?= number_format($item['price'], 2) ?></p>
                                <p class="card-text"><?= $item['description'] ?></p>
                                <!-- Quantity Control -->
                                <form action="cart.php" method="POST" class="d-flex justify-content-center align-items-center">
                                    <input type="hidden" name="item_id" value="<?= $itemId ?>">
                                    <button type="button" class="btn btn-outline-secondary quantity-btn minus" data-item-id="<?= $itemId ?>">-</button>
                                    <input type="number" name="quantity" class="form-control mx-2 text-center" value="<?= $item['quantity'] ?>" min="1" style="width: 60px;">
                                    <button type="button" class="btn btn-outline-secondary quantity-btn plus" data-item-id="<?= $itemId ?>">+</button>
                                    <button type="submit" name="update_quantity" style="display: none;"></button> <!-- Hidden submit button -->
                                </form>
                                <!-- Remove from Cart -->
                                <a href="cart.php?remove_from_cart=<?= $itemId ?>" class="btn btn-danger mt-2">Remove from Cart</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="col-12 text-center mt-4">
                    <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
                </div>
            <?php else: ?>
                <p class="text-center text-muted">Your cart is empty.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript to handle plus/minus buttons and form submission
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                const input = form.querySelector('input[name="quantity"]');
                let quantity = parseInt(input.value);

                if (this.classList.contains('minus')) {
                    quantity = Math.max(1, quantity - 1); // Ensure quantity doesn't go below 1
                } else if (this.classList.contains('plus')) {
                    quantity += 1;
                }

                input.value = quantity;
                form.querySelector('button[type="submit"]').click(); // Submit the form
            });
        });
    </script>
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
</body>
</html>