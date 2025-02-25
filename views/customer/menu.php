<?php
session_start(); // Start session to enable cart storage
require_once '../../controllers/MenuController.php';


$controller = new MenuController();
$menuItems = $controller->selectcategory(); // Get all items in the menu (including empty categories)
$offers = $controller->selectOffers(); // Get all special offers
// $menuItems = $controller->selectcat();

// Add item to the cart when clicked
if (isset($_GET['add_to_cart'])) {
    $itemId = $_GET['add_to_cart'];

    // Search for the item by its id and find its offer if it exists
    foreach ($menuItems as $categoryName => $items) {
        foreach ($items as $item) {
            if ($item['item_id'] == $itemId) {
                // Check if this item has an offer
                $newPrice = $item['price']; // Default is the original price
                foreach ($offers as $offer) {
                    if ($offer['item_id'] == $itemId) {
                        $newPrice = $offer['new_price']; // If there's an offer, set the new price
                        break;
                    }
                }

                // If the item is already in the cart, increase the quantity
                if (isset($_SESSION['cart'][$itemId])) {
                    $_SESSION['cart'][$itemId]['quantity']++;
                } else {
                    // Add the item to the cart with the appropriate price
                    $_SESSION['cart'][$itemId] = [
                        'id' => $item['item_id'],
                        'name' => $item['item_name'],
                        'price' => $newPrice, // Use the new price if there's an offer
                        'image' => $item['image'],
                        'description' => $item['description'],

                        'quantity' => 1
                    ];
                }
                break 2; // Stop looping once the item is found and added to the cart
            }
        }
    }

    require_once 'myextraitems.php';

    // Redirect the user to the cart page after adding the item

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
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
                    <li class="nav-item"><a class="btn btn-outline-light" href="#">Profile</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light" href="#">Menu</a></li>
                </ul>
                <a href="cart.php"> <i class="bi bi-cart cart-icon"></i></a>
                <button class="lang-btn">Sign Up</button>
                <button class="login-btn">Log In</button>
            </div>
        </div>
    </nav>

    <!-- Menu Section -->
    <div class="container my-5">
        <h2 class="text-center text-danger fw-bold">Restaurant Menu</h2>

        <!-- Regular Menu Items (Excluding items on offer) -->
        <div class="mt-5">
            <div class="row g-4 mt-4" id="menu-items">
                <?php if (count($menuItems) > 0): ?>
                    <?php foreach ($menuItems as $categoryName => $items): ?>
                        <h3 class="text-center text-primary"><?= $categoryName ?></h3>
                        <?php foreach ($items as $item): ?>
                            <?php
                            $newPrice = $item['price']; // Default is the original price
                            $isOfferItem = false;
                            foreach ($offers as $offer) {
                                if ($offer['item_id'] == $item['item_id']) {
                                    $newPrice = $offer['new_price']; // Use the new price if there's an offer
                                    $isOfferItem = true;
                                    break;
                                }
                            }

                            // Skip this item if it's on offer, we will show it later in the offer section
                            if ($isOfferItem) {
                                continue;
                            }
                            ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="<?= !empty($item['image']) ? '../../public/images/' . $item['image'] : 'default.jpg' ?>" class="card-img-top" alt="Food">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?= $item['item_name'] ?></h5>
                                        <p class="text-danger fw-bold">
                                            <?php if ($newPrice != $item['price']): ?>
                                                <del>$<?= number_format($item['price'], 2) ?></del>
                                            <?php endif; ?>
                                            $<?= number_format($newPrice, 2) ?>
                                        </p>
                                        <p class="card-text"><?= $item['description'] ?></p>
                                        <!-- <a href="myextraitems.php?item_id=<?= $item['item_id'] ?>" class="btn btn-danger w-100">Add to Cart</a> -->
                                        <button id="meal-btn"
                                            type="button"
                                            class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleModal<?= $item['item_id']; ?>"

                                            
                                            >

                                            add extra items for your meal
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-muted">No menu items available.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Display Special Offers -->
        <div class="mt-5">
            <h3 class="text-center text-primary">Special Offers</h3>
            <div class="row g-4 mt-4" id="offer-items">
                <?php if (count($offers) > 0): ?>
                    <?php foreach ($offers as $offer): ?>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="<?= !empty($offer['image']) ? '../../public/images/' . $offer['image'] : 'default.jpg' ?>" class="card-img-top" alt="Food">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= $item['item_name'] ?></h5>
                                    <p class="text-danger fw-bold">$<?= number_format($item['price'], 2) ?></p>
                                    <p class="card-text"><?= $item['description'] ?></p>
                                    <!-- هنا نقوم بإضافة الرابط لزر "Add to Cart" والذي يرسل مع الـ GET id المنتج -->
                                    <?php if ($item['available'] === 'yes'): ?>
                                        <a href="menu.php?add_to_cart=<?= $item['item_id'] ?>" class="btn btn-danger w-100">Add to Cart</a>
                                    <?php else: ?>
                                        <button class="btn btn-secondary w-100" disabled>Out of Stock</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-muted">No offers available.</p>
                <?php endif; ?>
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
<?php
    require_once 'myextraitems.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>