<?php
ob_start();
require_once "shared/navbar.php";
require_once '../../controllers/MenuController.php';
require_once '../../controllers/CategoryController.php';

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $item = new MenuController();
  $cat = $item->selectone($id);

  $cate = new CategoryController();
  $all = $cate->select();

  $name = $cat['name'];
  $cat_name = $cat['ctegory_name'];
  $description = $cat['description'];
  $price = $cat['price'];
  $image = $cat['image'];
  $available = $cat['available'];
}

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $cat_name = $_POST['ctegory_name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $available = $_POST['available'];
  $image = $_FILES['image']['name'];

  $destination = "../../public/images/" . basename($_FILES['image']['name']);
  move_uploaded_file($_FILES['image']['tmp_name'], $destination);

  $item->update($id, $name, $cat_name, $description, $price, $available, $image);
  header("Location: listitems.php");
  exit;

  // $category=new CategoryController();
  // $category->update($id, $name);
}

?>
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
            <h5 class="card-title">Edit Item</h5>

            <!-- General Form Elements -->
            <form method="POST" enctype="multipart/form-data">
              <?php if ($category): ?>
                <h3 class="text-success">Item updated successfully</h3>
              <?php endif; ?>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Edit Item</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" value="<?= $name; ?>" name="name">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                  <select class="form-control" name="ctegory_name">
                    <?php foreach ($all as $c) : ?>
                      <option value="<?php echo $c['id'] ?>" <?php echo ($c['id'] == $id) ? 'selected' : ''; ?>>
                        <?php echo $c['ctegory_name'] ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" value="<?= $description; ?> " name="description">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" value="<?= $price; ?>" name="price">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" name="image">
                  <img src="../../public/images/<?= $image ?>" width="50px" height="50px" alt="Drinks">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Available</label>
                <div class="col-sm-10">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="available" value="yes" id="availableYes" <?php echo ($available == 'yes') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="availableYes">Yes</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="available" value="no" id="availableNo" <?php echo ($available == 'no') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="availableNo">No</label>
                  </div>
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

<?php
require_once "shared/footer.php";
?>