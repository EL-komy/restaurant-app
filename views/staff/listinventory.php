<?php
require_once "shared/navbar.php";
require_once '../../controllers/InventoryController.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $inventoryController = new InventoryController();
    $inventoryController->delete($id);
}

$inventoryController = new InventoryController();
$inventory = $inventoryController->select();
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>List Inventory</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="addinventory.php">Add Inventory</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Inventory</h5>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Supplier</th>
                                    <th>Last Updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($inventory as $item): ?>
                                    <tr>
                                        <td><?= $item['id'] ?></td>
                                        <td><?= $item['item_name'] ?></td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td><?= $item['supplier_name'] ?? 'N/A' ?></td>
                                        <td><?= $item['last_updated'] ?></td>
                                        <td>
                                            <a href="?delete=<?= $item['id']; ?>" class="btn btn-danger">Delete</a>
                                            <a href="editinventory.php?edit=<?= $item['id']; ?>" class="btn btn-warning">Edit</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
require_once "shared/footer.php";
?>