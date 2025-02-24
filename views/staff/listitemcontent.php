<?php
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

<?php
require_once "shared/footer.php";
?>