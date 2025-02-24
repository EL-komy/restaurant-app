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
ob_start();
require_once "shared/navbar.php";
require_once '../../controllers/MenuController.php';

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $item = new MenuController();
  $cat = $item->selectone($id);

  $name = $cat['name'];
  $price = $cat['price'];
  $image = $cat['image'];
}

if (isset($_POST['submit'])) {
  $price = $_POST['price'];
  $expiry_date = $_POST['expiry_date'];
  // var_dump($_POST['expiry_date']);
  $item->insertOffer($id, $price, $expiry_date);
  header("Location: listitems.php");
  exit;
}

?>
<?php if($user['rolee'] == 2): ?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Edit Item</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>

        <li class="breadcrumb-item active"><a href="listitems.php">listitems</a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add Offer</h5>

            <!-- General Form Elements -->
            <form method="POST" enctype="multipart/form-data">
              <?php if ($category): ?>
                <h3 class="text-success">Offer updated successfully</h3>
              <?php endif; ?>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Edit Item</label>
                <div class="col-sm-10">
                  <label ><?= $name; ?></label>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                  <img src="../../public/images/<?= $image ?>" width="50px" height="50px" alt="Drinks">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Old Price</label>
                <div class="col-sm-10">
                  <label ><?= $price; ?></label>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">New Price</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control"  name="price">
                </div>
              </div>

              <div class="row mb-3">
                <label for="expiryDate" class="col-sm-2 col-form-label">Expiry Date</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="expiryDate" name="expiry_date" min="<?php echo date('Y-m-d'); ?>" required>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Update Button</label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary" name="submit">Update Item</button>
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