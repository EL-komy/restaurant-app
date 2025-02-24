<?php
require_once "shared/navbar.php";
require_once '../../controllers/ItemContentController.php';
require_once '../../controllers/MenuController.php';
require_once '../../controllers/InventoryController.php';

$item_id = '';
$inventory_id = '';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $itemContentController = new ItemContentController();
    $itemContent = $itemContentController->selectOne($id);

    if ($itemContent) {
        $item_id = $itemContent['item_id'];
        $inventory_id = $itemContent['inventory_id'];
    }

    if (isset($_POST['submit'])) {
        $item_id = $_POST['item_id'];
        $inventory_id = $_POST['inventory_id'];

        $result = $itemContentController->update($id, $item_id, $inventory_id);

        if ($result) {
            $successMessage = "Item content updated successfully!";
        } else {
            $errorMessage = "Failed to update item content. Please try again.";
        }
    }
}

// Fetch all menu items and inventory items for dropdowns
$menuItemController = new MenuController();
$menuItems = $menuItemController->select();

$inventoryController = new InventoryController();
$inventoryItems = $inventoryController->select();
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>EDIT ITEM CONTENT</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active"><a href="listitemcontent.php">Edit Item Content</a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Edit Item Content</h5>

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
                      <option value="<?php echo $menuItem['id']; ?>" <?= $menuItem['id'] == $item_id ? 'selected' : ''; ?>>
                          <?php echo $menuItem['name']; ?>
                      </option>
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
                      <option value="<?php echo $inventoryItem['id']; ?>" <?= $inventoryItem['id'] == $inventory_id ? 'selected' : ''; ?>>
                          <?php echo $inventoryItem['item_name']; ?>
                      </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Update Button</label>
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">Update Item Content</button>
              </div>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->

<?php
require_once "shared/footer.php";
?>