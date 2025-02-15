
<?php
require_once "shared/navbar.php";
// var_dump('error');
require_once '../../controllers/CategoryController.php';
// var_dump('error88');

if(isset($_POST['submit'])){
    $name=$_POST['category'];
    $category=new CategoryController();
    $category->insert($name);
}
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Add category</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
     
      <li class="breadcrumb-item active"><a href="listcategory.php">listcategory</a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Categories</h5>

          <!-- General Form Elements -->
          <form method="POST">
            <?php if($category):?>
              <h3 class="text-success">Category inserted successfully</h3>
            <?php endif;?>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Add category</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="category">
              </div>
            </div>
           


            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Submit Button</label>
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">Add Category</button>
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