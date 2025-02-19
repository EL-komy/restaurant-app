<?php
require_once "shared/navbar.php";
require_once '../../controllers/SupplierController.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $supplierController = new SupplierController();
    $supplierController->delete($id);
}

$supplierController = new SupplierController();
$suppliers = $supplierController->select();
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>List Suppliers</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="addsupplier.php">Add Supplier</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Suppliers</h5>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Supplier Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($suppliers as $supplier): ?>
                                    <tr>
                                        <td><?= $supplier['id'] ?></td>
                                        <td><?= $supplier['supplier_name'] ?></td>
                                        <td><?= $supplier['email'] ?></td>
                                        <td><?= $supplier['phone'] ?></td>
                                        <td>
                                            <a href="?delete=<?= $supplier['id']; ?>" class="btn btn-danger">Delete</a>
                                            <a href="editsupplier.php?edit=<?= $supplier['id']; ?>" class="btn btn-warning">Edit</a>
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