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

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $itemContentController = new ItemContentController();
    $itemContentController->delete($id);
}

$itemContentController = new ItemContentController();
$itemContents = $itemContentController->select();
?>
<?php if($user['rolee'] == 2): ?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>List Item Content</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active"><a href="additemcontent.php">Add Item Content</a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Item Content</h5>

          <table class="table datatable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Menu Item</th>
                <th>Inventory Item</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($itemContents as $itemContent): ?>
                <tr>
                    <td><?= $itemContent['id']; ?></td>
                    <td><?= $itemContent['item_name']; ?></td>
                    <td><?= $itemContent['inventory_name']; ?></td>
                    <td>
                        <a href="?delete=<?= $itemContent['id']; ?>" class="btn btn-danger">Delete</a>
                        <a href="edititemcontent.php?edit=<?= $itemContent['id']; ?>" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

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