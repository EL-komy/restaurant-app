<?php
session_start(); // Start session to enable cart storage
require_once '../../controllers/MenuController.php';
require_once '../../controllers/OptionsController.php';

$controller = new MenuController();
$controller2 = new OptionsController();
$menuItems = $controller->selectcategory(); // Get all items in the menu (including empty categories)
$offers = $controller->selectOffers(); // Get all special offers
$Items = $controller->selectItems();

// Add item to the cart when clicked
if (isset($_GET['add_to_cart'])) {
    $itemId = (int)$_GET['add_to_cart'];
    // var_dump($itemId);
    
    // Check if options are submitted with the form
    $selectedOptions = [];
    if (isset($_POST) && !empty($_POST)) {
        // Loop through posted options and store them
        foreach ($_POST as $key => $value) {
            if ($value !== 'none') { // Only add options that aren't "none"
                $selectedOptions[$key] = $value;
            }
        }
    }
    
    // Convert options array to text
    $optionsText = '';
    if (!empty($selectedOptions)) {
        $optionPairs = [];
        foreach ($selectedOptions as $name => $value) {
            $optionPairs[] = "$name: $value";
        }
        $optionsText = implode(', ', $optionPairs);
    }

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
                    // Update options if new ones are selected
                    if (!empty($optionsText)) {
                        $_SESSION['cart'][$itemId]['options'] = $optionsText;
                        $_SESSION['cart'][$itemId]['options_array'] = $selectedOptions;
                    }
                } else {
                    // Add the item to the cart with the appropriate price
                    $_SESSION['cart'][$itemId] = [
                        'id' => (int)$_GET['add_to_cart'],
                        'name' => $item['item_name'],
                        'price' => $newPrice, // Use the new price if there's an offer
                        'image' => $item['image'],
                        'description' => $item['description'],
                        'options' => $optionsText,
                        // 'options_array' => $selectedOptions,
                        'quantity' => 1
                    ];
                }
                
                // Debugging - you can remove this in production
                
                    // echo "<pre>";
                    // // var_dump($_SESSION['cart'][$itemId]);
                    // var_dump($_SESSION['cart']);
                    // echo "</pre>";
                
                
                break 2; // Stop looping once the item is found and added to the cart
            }
        }
    }

    // Redirect the user to the cart page after adding the item
    // Uncomment these lines when ready to use
    // header("Location: cart.php");
    // exit();
    
    // exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../public/css/index.css">
   
</head>

<body>
    <!-- Navbar -->
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
                <li class="nav-item"><a class="btn btn-outline-light" href="http://localhost:8080/views/shared/userinfo.php">Profile</a></li>
                <li class="nav-item"><a class="btn btn-outline-light" href="#">Menu</a></li>
            </ul>
            <a href="cart.php" class="btn btn-outline-light position-relative">
                <i class="bi bi-cart cart-icon"></i>
                <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= array_sum(array_column($_SESSION['cart'] ?? [], 'quantity')) ?>
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

<style>
    /* Sticky Navbar */
    .navbar.sticky-top {
        position: sticky;
        top: 0;
        z-index: 1000;
    }
</style>
    
    <?php foreach ($Items as $item): ?>
        <div class="modal fade" id="exampleModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Customize Your Meal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $options = $controller2->selectall($item['id']);
                        ?>

                        <form action="menu.php?add_to_cart=<?= $item['id'] ?>" method="POST">
                            <div id="side-item-section" class="mb-5">
                                <h5 class="text-danger">Select Your Favorite Extra </h5>
                                <?php foreach ($options as $option): ?>
                                    <div class="my-3 p-2 border rounded">
                                        <div class="d-flex align-items-center">
                                            <img src="../../public/images/<?php echo $option['image']; ?>" alt="" width="60" class="me-2">
                                            <strong><?= $option['name']; ?></strong>
                                        </div>
                                        <div class="mt-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="<?= $option['name']; ?>" value="none" >
                                                <label class="form-check-label">None</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="<?= $option['name']; ?>" value="regular" checked>
                                                <label class="form-check-label">Regular</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="<?= $option['name']; ?>" value="extra">
                                                <label class="form-check-label">Extra</label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button type="submit" class="btn btn-danger w-100">Add to Cart with Options</button>
                        </form>
                        <button type="button" class="btn btn-secondary mt-2" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

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
                                        <button id="meal-btn"
                                            type="button"
                                            class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleModal<?= $item['item_id']; ?>">
                                            Add extra items for your meal
                                        </button>
                                        <a href="menu.php?add_to_cart=<?= $item['item_id'] ?>" class="btn btn-danger w-100 mt-2">Add to Cart (No extras)</a>
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
                        <?php
                        // Find the item details for this offer
                        $offerItem = null;
                        foreach ($menuItems as $catItems) {
                            foreach ($catItems as $item) {
                                if ($item['item_id'] == $offer['item_id']) {
                                    $offerItem = $item;
                                    break 2;
                                }
                            }
                        }
                        
                        if (!$offerItem) continue; // Skip if item not found
                        ?>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="<?= !empty($offerItem['image']) ? '../../public/images/' . $offerItem['image'] : 'default.jpg' ?>" class="card-img-top" alt="Food">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= $offer['item_name'] ?></h5>
                                    <p class="text-danger fw-bold">$<?= number_format($offer['new_price'], 2) ?></p>
                                    <p class="card-text"><?= $offer['description'] ?></p>
                                    <a href="menu.php?add_to_cart=<?= $offer['item_id'] ?>" class="btn btn-danger w-100">Add to Cart</a>
                                    <h5 class="card-title"><?= $offerItem['item_name'] ?></h5>
                                    <p class="text-danger fw-bold">
                                        <del>$<?= number_format($offerItem['price'], 2) ?></del>
                                        $<?= number_format($offer['new_price'], 2) ?>
                                    </p>
                                    <p class="card-text"><?= $offerItem['description'] ?></p>
                                    <p class="card-text"><?= $offerItem['available'] ?>fdfddf</p>
                                    <?php if ($offerItem['available'] == 'yes'): ?>
                                        <button id="meal-btn"
                                            type="button"
                                            class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleModal<?= $offerItem['item_id']; ?>">
                                            Add extra items for your meal
                                        </button>
                                        <a href="menu.php?add_to_cart=<?= $offerItem['item_id'] ?>" class="btn btn-danger w-100 mt-2">Add to Cart (No extras)</a>
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

    <!-- JavaScript to Prevent Double-Clicking -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartButtons = document.querySelectorAll('a[href*="add_to_cart"]');
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault(); // Prevent the default link behavior
                    const url = this.getAttribute('href');
                    this.style.pointerEvents = 'none'; // Disable the button after click
                    this.innerText = 'Adding...'; // Change button text to indicate loading
                    window.location.href = url; // Redirect to the add_to_cart URL
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>