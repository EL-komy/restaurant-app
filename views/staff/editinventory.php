<?php
require_once "shared/navbar.php";
require_once '../../controllers/InventoryController.php';
require_once '../../controllers/SupplierController.php';

$item_name = '';
$quantity = '';
$supplier_id = '';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $inventoryController = new InventoryController();
    $item = $inventoryController->selectOne($id);

    if ($item) {
        $item_name = $item['item_name'];
        $quantity = $item['quantity'];
        $supplier_id = $item['supplier_id'];
    }

    if (isset($_POST['submit'])) {
        $item_name = $_POST['item_name'];
        $quantity = $_POST['quantity'];
        $supplier_id = $_POST['supplier_id'];

        $inventoryController->update($id, $item_name, $quantity, $supplier_id);
        echo "<h3 class='text-success'>Inventory item updated successfully</h3>";
    }
}

$supplierController = new SupplierController();
$suppliers = $supplierController->select();
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Inventory</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="listinventory.php">List Inventory</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Inventory</h5>
                        <form method="POST">
                            <div class="row mb-3">
                                <label for="item_name" class="col-sm-2 col-form-label">Item Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="item_name" value="<?= $item_name; ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="quantity" value="<?= $quantity; ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="supplier_id" class="col-sm-2 col-form-label">Supplier</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="supplier_id" required>
                                        <option value="">Select Supplier</option>
                                        <?php foreach ($suppliers as $supplier): ?>
                                            <option value="<?= $supplier['id'] ?>" <?= $supplier['id'] == $supplier_id ? 'selected' : ''; ?>>
                                                <?= $supplier['supplier_name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Update Button</label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="submit">Update Inventory</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
require_once "shared/footer.php";
?>