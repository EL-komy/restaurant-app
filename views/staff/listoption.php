
<?php
require_once "shared/navbar.php";
require_once '../../controllers/MenuController.php';
require_once '../../controllers/OptionsController.php';
if(isset($_GET['delete'])){
 $id=$_GET['delete'];
 $delete=new OptionsController();
 $delete->delete($id);
}
$item=new optionsController();
$cat=$item->select();
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Data Tables</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      
      <li class="breadcrumb-item active"><a href="category.php">List Options</a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-6 ">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Options</h5>
          

          
          <table class="table datatable">
            <thead>
              <tr>
                <th>Id</th>
                <th>
                  <b>N</b>ame
                </th>
                <td>Item</td>
               <th>Image</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach($cat as $item): ?>
                <tr>
                    <td><?= $item['option_id']?></td>
                    <td><?= $item['option_name']?></td> 
                    <td><?= $item['menu_item_name']?></td>
                    <td> <img src="../../public/images/<?= $item['option_image']?>" width="50px" height="50px" alt="Drinks"></td>
                    <td>
                        <a href="?delete=<?=$item['option_id'];?>" class="btn btn-danger">Delete</a>
                        <a href="editoption.php?edit=<?=$item['option_id'];?>" class="btn btn-warning">Edit</a>
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