<?php
require_once "shared/navbar.php";

require_once '../../controllers/TableController.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = new TableController();
    $delete->delete($id);
}

$tableController = new TableController();
$tables = $tableController->select();
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Data Tables</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active"><a href="addtable.php">Add Table</a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-6">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tables</h5>

          <table class="table datatable">
            <thead>
              <tr>
                <th>Id</th>
                <th>Chairs</th>
                <th>Available</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($tables as $table): ?>
                <tr>
                    <td><?= $table['id'] ?></td>
                    <td><?= $table['chairs'] ?></td>
                    <td><?= $table['available'] ? 'Yes' : 'No' ?></td>
                    <td>
                        <a href="?delete=<?= $table['id']; ?>" class="btn btn-danger">Delete</a>
                        <a href="edittable.php?edit=<?= $table['id']; ?>" class="btn btn-warning">Edit</a>
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

</main>
<?php
require_once "shared/footer.php";
?>