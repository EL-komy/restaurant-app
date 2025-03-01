<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start session to access user data

// Include the Database class
require_once '../../config/db.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if the user is not logged in
    exit();
}

try {
    // Create a new instance of the Database class and connect to the database
    $database = new Database();
    $pdo = $database->connect();

    // Fetch the user's ID from the session
    $email = $_SESSION['email']; // Assuming the email is stored in the session
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("User not found."); // Handle the case where the user doesn't exist
    }

    $userId = $user['id']; // Get the user_id

    // Fetch the user's order history
    $stmt = $pdo->prepare("
        SELECT o.id AS order_id, o.total_price, o.created_at, p.payment_method, p.status AS payment_status
        FROM orders o
        JOIN payments p ON o.id = p.order_id
        WHERE o.user_id = ?
        ORDER BY o.created_at DESC
    ");
    $stmt->execute([$userId]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage()); // Display database errors
} catch (Exception $e) {
    die("Error: " . $e->getMessage()); // Display other errors
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            /* Remove padding-top from body */
        }
        .navbar {
    background-color: white !important; /* White background */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
    z-index: 1000; /* Ensure navbar stays above other content */
}

        .order-history-container {
            max-width: 800px;
            margin: 80px auto 20px; /* Add margin-top to create space below the navbar */
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .order-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .order-card h5 {
            margin-bottom: 10px;
        }

        .order-card p {
            margin: 5px 0;
        }

        .order-card .status {
            font-weight: bold;
        }

        .order-card .status.pending {
            color: #ffc107; /* Yellow for pending */
        }

        .order-card .status.completed {
            color: #28a745; /* Green for completed */
        }

        .order-card .status.failed {
            color: #dc3545; /* Red for failed */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
   <!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top" style="background-color: white; z-index: 1000;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="../../public/images/logo2.jpg" alt="Logo" width="50px" height="50px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="../../index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="shared/userinfo.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
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
                <a href="./views/shared/login.php" class="btn btn-danger">Log In</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
    <!-- Order History Section -->
    <div class="order-history-container">
        <h2 class="text-center text-danger fw-bold mb-4">Order History</h2>

        <?php if (empty($orders)): ?>
            <p class="text-center text-muted">No orders found.</p>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-card">
                    <h5>Order #<?= htmlspecialchars($order['order_id']) ?></h5>
                    <p><strong>Total Price:</strong> $<?= htmlspecialchars($order['total_price']) ?></p>
                    <p><strong>Order Date:</strong> <?= htmlspecialchars($order['created_at']) ?></p>
                    <p><strong>Payment Method:</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
                    <p><strong>Payment Status:</strong>
                        <span class="status <?= htmlspecialchars($order['payment_status']) ?>">
                            <?= htmlspecialchars($order['payment_status']) ?>
                        </span>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
     <!-- Footer -->
     <footer id="contact" class="footer text-center ">
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