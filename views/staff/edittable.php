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

require_once '../../controllers/TableController.php';

$chairs = '';
$available = false;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $tableController = new TableController();
    $table = $tableController->selectOne($id);

    if ($table) {
        $chairs = $table['chairs'];
        $available = $table['available'];
    }

    if (isset($_POST['submit'])) {
        $chairs = $_POST['chairs'];
        $available = isset($_POST['available']) ? true : false;

        $tableController->update($id, $chairs, $available);
        echo "<h3 class='text-success'>Table updated successfully</h3>";
    }
}
?>
<?php if($user['rolee'] == 2): ?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>EDIT TABLE</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active"><a href="listtables.php">Edit Table</a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Edit Table</h5>

          <!-- General Form Elements -->
          <form method="POST">
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Number of Chairs</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" value="<?= $chairs; ?>" name="chairs" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Available</label>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="available" id="available" <?= $available ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="available">
                    Check if the table is available
                  </label>
                </div>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Update Button</label>
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">Update Table</button>
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