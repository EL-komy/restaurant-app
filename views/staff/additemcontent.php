<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../shared/login.php");
    exit();
}
require_once '../../config/db.php';
require_once '../../models/User.php';
$database = new Database();
$db = $database->connect();
$userModel = new User($db);
$user = $userModel->select($_SESSION['email']);

// Check if the user is an admin
if ($user['rolee'] != 2) { // Assuming rolee is the column name for role in your database
    header("Location: error.php");
    exit();
}
require_once "shared/navbar.php";
require_once '../../controllers/ItemContentController.php';
require_once '../../controllers/MenuController.php';
require_once '../../controllers/InventoryController.php';

// Fetch all menu items and inventory items for dropdowns
$menuItemController = new MenuController();
$menuItems = $menuItemController->select();

$inventoryController = new InventoryController();
$inventoryItems = $inventoryController->select();

// Handle form submission
if (isset($_POST['submit'])) {
    $item_id = $_POST['item_id'];
    $inventory_id = $_POST['inventory_id'];

    $itemContentController = new ItemContentController();
    $result = $itemContentController->insert($item_id, $inventory_id);

    if ($result) {
        $successMessage = "Item content added successfully!";
    } else {
        $errorMessage = "Failed to add item content. Please try again.";
    }
}
?>
<?php if($user['rolee'] == 2): ?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Add Item Content</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active"><a href="listitemcontent.php">List Item Content</a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Item Content</h5>

          <!-- Display success or error message -->
          <?php if (isset($successMessage)): ?>
              <div class="alert alert-success"><?php echo $successMessage; ?></div>
          <?php endif; ?>
          <?php if (isset($errorMessage)): ?>
              <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
          <?php endif; ?>

          <!-- General Form Elements -->
          <form method="POST">
            <div class="row mb-3">
              <label for="item_id" class="col-sm-2 col-form-label">Menu Item</label>
              <div class="col-sm-10">
                <select class="form-control" name="item_id" id="item_id" required>
                  <option value="">Select a Menu Item</option>
                  <?php foreach ($menuItems as $menuItem): ?>
                      <option value="<?php echo $menuItem['id']; ?>"><?php echo $menuItem['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inventory_id" class="col-sm-2 col-form-label">Inventory Item</label>
              <div class="col-sm-10">
                <select class="form-control" name="inventory_id" id="inventory_id" required>
                  <option value="">Select an Inventory Item</option>
                  <?php foreach ($inventoryItems as $inventoryItem): ?>
                      <option value="<?php echo $inventoryItem['id']; ?>"><?php echo $inventoryItem['item_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Submit Button</label>
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">Add Item Content</button>
              </div>
            </div>

          </form>

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->
<?php endif; ?>

<?php
// Only include the footer if the user is an admin
if ($user['rolee'] == 2) {
    require_once "shared/footer.php";
}
?>