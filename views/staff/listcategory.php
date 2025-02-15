<?php
require_once "shared/navbar.php";

require_once '../../controllers/CategoryController.php';
if(isset($_GET['delete'])){
  $id=$_GET['delete'];
  $delete=new CategoryController();
  $delete->delete($id);
  
}

$category=new CategoryController();
$cat=$category->select();

?>
 <main id="main" class="main">

<div class="pagetitle">
  <h1>Data Tables</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      
      <li class="breadcrumb-item active"><a href="category.php">Add Category</a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-6 ">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Categories</h5>
          

          
          <table class="table datatable">
            <thead>
              <tr>
                <th>Id</th>
                <th>
                  <b>N</b>ame
                </th>
               
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach($cat as $item): ?>
                <tr>
                    <td><?= $item['id']?></td>
                    <td><?= $item['ctegory_name']?></td> 
                    <td>
                        <a href="?delete=<?=$item['id'];?>" class="btn btn-danger">Delete</a>
                        <a href="editcategory.php?edit=<?=$item['id'];?>" class="btn btn-warning">Edit</a>
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