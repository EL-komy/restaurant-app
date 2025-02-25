<?php
session_start();

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
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
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="btn btn-outline-light" href="../../index.php">Home</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light" href="#">Profile</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light" href="menu.php">Menu</a></li>
                </ul>
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
                            <img src="../../public/images/<?= $item['image'] ?>" class="card-img-top" alt="Food">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $item['name'] ?></h5>
                                <p class="text-danger fw-bold">$<?= number_format($item['price'], 2) ?></p>
                                <p class="card-text"><?= $item['description'] ?></p>
                                <p>Quantity: <?= $item['quantity'] ?></p>
                                <!-- Option to remove item from the cart -->
                                <a href="cart.php?remove_from_cart=<?= $itemId ?>" class="btn btn-danger">Remove from Cart</a>
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
</body>

</html>