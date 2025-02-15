
<?php
require_once "shared/navbar.php";
require_once '../../controllers/MenuController.php';
require_once '../../controllers/OptionsController.php';
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
                    <td><?= $item['id']?></td>
                    <td><?= $item['name']?></td> 
                    <td><?= $item['item_id']?></td>
                    <td><img src="" alt="itemimage"></td>
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