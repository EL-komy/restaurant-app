<?php
require_once "shared/navbar.php";
require_once '../../controllers/MenuController.php';
require_once '../../controllers/OptionsController.php';

if (isset($_POST['submit'])) {
    $item_id = $_POST['item'];
    $optionname = $_POST['option']; // Ensure this is not null
    $image = null;

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $destination = "../../public/images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
    }

    // Validate inputs
    if (empty($optionname)) {
        die("Error: Option name cannot be empty.");
    }

    // Insert into database
    $option = new OptionsController();
    $option->insert($item_id, $optionname, $image);
}

$cat = new MenuController();
$all = $cat->select();
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">LIST Item Option</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Item Option</h5>
                        <form method="POST" enctype="multipart/form-data">
                            <?php if ($option): ?>
                                <h3 class="text-success">Option inserted successfully</h3>
                            <?php endif; ?>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Option Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="option" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Image Upload</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="formFile" name="image">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Select</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="item" required>
                                        <option value="" selected>Select Item</option>
                                        <?php foreach ($all as $c): ?>
                                            <option value="<?php echo $c['id']; ?>"><?php echo $c['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Submit Button</label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="submit">Add Option Item</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
require_once "shared/footer.php";
?>