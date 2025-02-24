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

require_once '../../controllers/MenuController.php';
if(isset($_GET['delete'])){
  $id=$_GET['delete'];
  $delete=new MenuController();
  $delete->delete($id);
  
}

$item=new MenuController();
$cat=$item->select();

?>
<?php if($user['rolee'] == 2): ?>
 <main id="main" class="main">

<div class="pagetitle">
  <h1>Data Tables</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      
      <li class="breadcrumb-item active"><a href="category.php">Add Item</a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12 ">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Items</h5>
          

          
          <table class="table datatable">
            <thead>
              <tr>
                <th>Id</th>
                <th>
                  <b>N</b>ame
                </th>
                <th>category</th>
                <th>description</th>
                <th>price</th>
                <th>image</th>
                <th>available</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach($cat as $item): ?>
                <tr>
                    <td><?= $item['id']?></td>
                    <td><?= $item['name']?></td> 
                    <td><?= $item['ctegory_name']?></td> 
                    <td><?= $item['description']?></td> 
                    <td><?= $item['price']?></td> 
                    <td>
                    <img src="../../public/images/<?= $item['image']?>" width="50px" height="50px" alt="Drinks">
                    </td>
                    <td><?= $item['available']?></td> 
                    
                    <td>
                        <a href="?delete=<?=$item['id'];?>" class="btn btn-danger">Delete</a>
                        <a href="edititem.php?edit=<?=$item['id'];?>" class="btn btn-warning">Edit</a>
                        <a href="offers.php?edit=<?=$item['id'];?>" class="btn btn-primary">Add Offers</a>
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
<?php endif; ?>

<?php
// Only include the footer if the user is an admin
if ($user['rolee'] == 2) {
    require_once "shared/footer.php";
}
?>