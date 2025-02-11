<?php
require_once "shared/navbar.php";
require_once "../../controllers/CustomerController.php";

$controller= new CustomerController();
    

if(isset($_POST['delete'])){
    $controller->delete($_POST['id']);
}

if(isset($_POST['edit'])){
    $controller->delete($_POST['id']);
}
$users=$controller->selectAll();


?>
<main id="main" class="main">


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datatables</h5>


                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            <?php
                             if (count($users) > 0) {
                                foreach ($users as $user) {
                                    echo "<tr>";
                                    echo "<td>{$user['id']}</td>";
                                    echo "<td>{$user['user_name']}</td>";
                                    echo "<td>{$user['email']}</td>";
                                    echo "<td>{$user['phone']}</td>";
                                    echo "<td>{$user['addresss']}</td>";
                                    echo "<td>{$user['created_at']}</td>";

                                    echo '<td><div style="display:flex; gap:10px;">';
                                    echo '<form method="post" action="">
                                            <input type="hidden" name="id" value="' . $user['id'] . '">
                                            <button class="btn btn-danger rounded-pill" name="delete" type="submit">Delete</button>
                                          </form>';
                                    echo '<form method="post" action="">
                                          <input type="hidden" name="id" value="' . $user['id'] . '">
                                          <button class="btn btn-primary rounded-pill" type="submit" name="edit">Edit</button>
                                        </form>';
                                    echo '</div></td>';
                                    echo '</tr>';
                                }
                             } 
                             else {
                                echo "No data found in the users table.";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php
require_once "shared/footer.php";
?>