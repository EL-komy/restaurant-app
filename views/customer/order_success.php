<?php
session_start(); // Start session to access order details

// Retrieve order details from session
$orderId = $_SESSION['order_id'] ?? 'N/A';
$totalPrice = $_SESSION['total_price'] ?? '0.00';
$paymentMethod = $_SESSION['payment_method'] ?? 'N/A';

// Clear session data after displaying
unset($_SESSION['order_id']);
unset($_SESSION['total_price']);
unset($_SESSION['payment_method']);
unset($_SESSION['cart']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .success-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1rem;
        }

        .btn-continue-shopping {
            background-color: #28a745;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 1.5rem;
        }

        .btn-continue-shopping:hover {
            background-color: #218838;
        }

        .order-summary {
            margin-top: 1.5rem;
            text-align: left;
        }

        .order-summary h5 {
            margin-bottom: 1rem;
        }

        .order-summary p {
            margin: 0.5rem 0;
        }
    </style>
</head>

<body>
    <div class="success-container">
        <!-- Success Icon -->
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>

        <!-- Success Message -->
        <h2>Order Placed Successfully!</h2>
        <p>Thank you for your purchase. Your order has been successfully placed.</p>

        <!-- Order Summary -->
        <div class="order-summary">
            <h5>Order Summary</h5>
            <p><strong>Order ID:</strong><?=$orderId?></p> <!-- Replace with dynamic order ID if available -->
            <p><strong>Total Amount:</strong> <?=$totalPrice;?></p> <!-- Replace with dynamic total amount -->
            <p><strong>Payment Method:</strong> <?=$paymentMethod;?></p> <!-- Replace with dynamic payment method -->
        </div>

        <!-- Continue Shopping Button -->
        <a href="menu.php" class="btn-continue-shopping">
            Continue Shopping
        </a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>