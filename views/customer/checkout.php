<?php
require_once '../../controllers/OptionsController.php';
require_once '../../config/db.php';
session_start(); // Start session to access cart data

// Redirect to the menu page if the cart is empty
$database = new Database();
$pdo = $database->connect();

// Redirect to the menu page if the cart is empty
if (empty($_SESSION['cart'])) {
    header("Location: menu.php");
    exit();
}

// Calculate the total order price
$totalPrice = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}

// Handle form submission for payment method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentMethod = $_POST['payment_method'];

    // Fetch user_id from the database using the email stored in the session
    $email = $_SESSION['email']; // Assuming the email is stored in the session
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("User not found."); // Handle the case where the user doesn't exist
    }

    $userId = $user['id']; // Get the user_id
    $status = 'pending'; // Default status

    // Step 1: Insert into the `orders` table
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, status, total_price) VALUES (?, ?, ?)");
    $stmt->execute([$userId, $status, $totalPrice]);
    $orderId = $pdo->lastInsertId(); // Get the ID of the newly inserted order

    // Step 2: Insert into the `order_details` table
    foreach ($_SESSION['cart'] as $itemId => $item) {
        $stmt = $pdo->prepare("INSERT INTO order_details (order_id, item_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$orderId, $itemId, $item['quantity'], $item['price']]);
    }

    foreach ($_SESSION['cart'] as $itemId => $item) {
        $stmt = $pdo->prepare("INSERT INTO order_options (order_id, menu_item_id, customizations) VALUES (?, ?, ?)");
        $stmt->execute([$orderId, $itemId, $item['options'] ]);
    }

    // Step 3: Insert into the `payments` table
    $paymentStatus = 'pending'; // Default payment status
    $stmt = $pdo->prepare("INSERT INTO payments (order_id, payment_method, amount, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([$orderId, $paymentMethod, $totalPrice, $paymentStatus]);
    $_SESSION['order_id'] = $orderId;
    $_SESSION['total_price'] = $totalPrice;
    $_SESSION['payment_method'] = $paymentMethod;

    // Redirect to the success page
    header("Location: order_success.php");
    exit();

    // Clear the cart after the order is placed

    // Redirect to a success page or display a success message
    // Redirect to the success page with order details

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../public/css/index.css">
    <style>
        .cart-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .payment-method {
            margin-top: 20px;
        }

        .total-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #dc3545;
            /* Red color */
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
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
                    <li class="nav-item"><a class="btn btn-outline-light" href="../../index.php">Home</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light" href="shared/userinfo.php">Profile</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light" href="menu.php">Menu</a></li>
                </ul>
                <a href="cart.php" class="btn btn-outline-light position-relative me-3">
                    <i class="fas fa-shopping-cart" style="color: red;"></i> <!-- FontAwesome Cart Icon -->
                    <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?= array_sum(array_column($_SESSION['cart'] ?? [], 'quantity')) ?>
                    </span>
                </a>
                <!-- Logout Button -->
                <?php if (isset($_SESSION['email'])): ?>
                    <a href="config/logout.php" class="btn btn-danger">Log Out</a>
                <?php else: ?>
                    <a href="http://localhost:8080/views/shared/login.php" class="btn btn-danger">Log In</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Checkout Section -->
    <div class="container my-5">
        <h2 class="text-center text-danger fw-bold">Checkout</h2>

        <!-- Display Cart Items -->
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-primary">Your Order</h4>
                <?php foreach ($_SESSION['cart'] as $itemId => $item): ?>
                    <div class="cart-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5><?= $item['name'] ?></h5>
                                <p class="text-muted">Quantity: <?= $item['quantity'] ?></p>
                            </div>
                            <div>
                                <p class="text-danger fw-bold">$<?= number_format($item['price'] * $item['quantity'], 2) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Display Total Order Price -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <h4 class="text-primary">Total Price:</h4>
                    <p class="total-price">$<?= number_format($totalPrice, 2) ?></p>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="col-md-12 payment-method">
                <h4 class="text-primary">Payment Method</h4>
                <form action="checkout.php" method="POST">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="visa" value="visa" required>
                        <label class="form-check-label" for="visa">
                            <i class="bi bi-credit-card"></i> Visa
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="cash" value="cash" required>
                        <label class="form-check-label" for="cash">
                            <i class="bi bi-cash"></i> Cash on Delivery
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mt-3">Place Order</button>
                </form>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>