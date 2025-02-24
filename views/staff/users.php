<?php
require_once "shared/navbar.php";
require_once "../../controllers/CustomerController.php";

$controller = new CustomerController();


if (isset($_POST['delete'])) {
    $controller->delete($_POST['id']);
}

if (isset($_POST['changeRole'])) {
    $controller->changeRole($_POST['id'], $_POST['role']);
}
$users = $controller->selectAll();


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
                                    <th data-type="date" data-format="YY/DD/MM">Created Date</th>
                                    <th>role</th>
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
                                        echo "<td style='width: 50px;'>{$user['email']}</td>";
                                        echo "<td>{$user['phone']}</td>";
                                        echo "<td>{$user['addresss']}</td>";
                                        echo "<td>{$user['created_at']}</td>";
                                        echo '<td><div style="display:flex; gap:10px;">';
                                        echo '<form method="post" action="">
                                        <input type="hidden" name="id" value="' . $user['id'] . '">
                                        <select name="role" class="form-select" style="width: 100px;">
                                            <option value="1" ' . ($user['rolee'] == 1 ? 'selected' : '') . '>Customer</option>
                                            <option value="2" ' . ($user['rolee'] == 2 ? 'selected' : '') . '>Admin</option>
                                        </select>
                                      
                                        <button class="btn btn-primary " style="width: 100px;" name="changeRole" type="submit">Change</button>
                                      </form>';

                                        echo '<td><div style="display:flex; gap:10px;">';
                                        echo '<form method="post" action="">
                                            <input type="hidden" name="id" value="' . $user['id'] . '">
                                            <button class="btn btn-danger " style="width: 100px;" name="delete" type="submit">Delete</button>
                                            </form>';
                                            echo '</div></td>';
                                        // echo '<form method="post" action="">
                                        //       <input type="hidden" name="id" value="' . $user['id'] . '">
                                        //       <button class="btn btn-primary rounded-pill" type="submit" name="edit">Edit</button>
                                        //     </form>';
                                        echo '</div></td>';
                                        echo '</tr>';
                                    }
                                } else {
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