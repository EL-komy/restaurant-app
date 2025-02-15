<?php
require_once "shared/navbar.php";
// var_dump('error');
require_once '../../controllers/MenuController.php';
require_once '../../controllers/CategoryController.php';
// var_dump('error88');

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $category = $_POST['category'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $image = $_FILES['image']['name'];
  $available = $_POST['available'];

  $destination = "../../public/images/" . basename($_FILES['image']['name']);

  // var_export($_FILES['image']['name']);

  move_uploaded_file($_FILES['image']['tmp_name'], $destination);
  $item = new MenuController();
  $item->insert($name, $category, $description, $price, $image, $available);
}
$cat = new CategoryController();
$all = $cat->select();


?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Add Item</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>

        <li class="breadcrumb-item active"><a href="listitems.php">List Items</a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Menu Items</h5>

            <!-- General Form Elements -->
            <form method="POST" enctype="multipart/form-data">
              <?php if ($category): ?>
                <h3 class="text-success">Item inserted successfully</h3>
              <?php endif; ?>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="name">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                  <select class="form-control" name="category">
                    <?php foreach ($all as $c) : ?>
                      <option value="<?php echo $c['id'] ?>"><?php echo $c['ctegory_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="description">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="price">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" name="image">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Available</label>
                <div class="col-sm-10">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="available" value="yes" id="availableYes" checked>
                    <label class="form-check-label" for="availableYes">Yes</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="available" value="no" id="availableNo">
                    <label class="form-check-label" for="availableNo">No</label>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Submit Button</label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary" name="submit">Add Item</button>
                </div>
              </div>

            </form>

          </div>
        </div>

      </div>


    </div>
  </section>

</main><!-- End #main -->

<?php
require_once "shared/footer.php";
?>