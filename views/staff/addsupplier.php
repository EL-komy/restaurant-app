<?php
require_once "shared/navbar.php";
require_once '../../controllers/SupplierController.php';

if (isset($_POST['submit'])) {
    $supplier_name = $_POST['supplier_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $supplierController = new SupplierController();
    $result = $supplierController->insert($supplier_name, $email, $phone);

    if ($result) {
        echo "<h3 class='text-success'>Supplier added successfully</h3>";
    } else {
        echo "<h3 class='text-danger'>Failed to add supplier</h3>";
    }
}
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add Supplier</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="listsuppliers.php">List Suppliers</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Supplier</h5>
                        <form method="POST">
                            <div class="row mb-3">
                                <label for="supplier_name" class="col-sm-2 col-form-label">Supplier Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="supplier_name" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="phone" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Submit Button</label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="submit">Add Supplier</button>
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