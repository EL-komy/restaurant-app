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

if (isset($_POST['submit'])) {
    $chairs = $_POST['chairs'];
    $available = isset($_POST['available']) ? true : false; // Checkbox value

    $tableController = new TableController();
    $tableController->insert($chairs, $available);
}
?>
<?php if($user['rolee'] == 2): ?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Add Table</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active"><a href="listtables.php">List Tables</a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tables</h5>

          <!-- General Form Elements -->
          <form method="POST">
            <?php if (isset($table)): ?>
              <h3 class="text-success">Table inserted successfully</h3>
            <?php endif; ?>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Number of Chairs</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="chairs" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Available</label>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="available" id="available">
                  <label class="form-check-label" for="available">
                    Check if the table is available
                  </label>
                </div>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Submit Button</label>
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">Add Table</button>
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