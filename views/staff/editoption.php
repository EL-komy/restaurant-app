<?php
ob_start();
require_once "shared/navbar.php";
require_once '../../controllers/MenuController.php';
require_once '../../controllers/OptionsController.php';

// Fetch all menu items for the dropdown
$menu = new MenuController();
$allItems = $menu->select();

// Check if editing an existing option
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $optionsController = new OptionsController();
    $option = $optionsController->selectOne($id); // Fetch the option details using the new selectOne method

    if ($option) {
        // Populate form fields with existing data
        $item_id = $option['menu_item_id'];
        $name = $option['option_name'];
        $image = $option['option_image'];
    } else {
        echo "Error: Option not found.";
        exit;
    }
} else {
    // Default values for add mode
    $item_id = '';
    $name = '';
    $image = '';
}

// Handle form submission
if (isset($_POST['submit'])) {
    $item_id = $_POST['item'];
    $name = $_POST['option'];
    $image = $_FILES['image']['name'];

    // Handle file upload
    if (!empty($_FILES['image']['name'])) {
        $destination = "../../public/images/" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
    } else {
        $image = $option['option_image']; // Retain the existing image if no new file is uploaded
    }

    // Insert or update the option
    $optionsController = new OptionsController();
    if (isset($_GET['edit'])) {
        // Update existing option
        $optionsController->update($id, $item_id, $name, $image);
        header("Location: listoption.php"); // Redirect after update
        exit;
    } else {
        // Insert new option
        $optionsController->insert($item_id, $name, $image);
        header("Location: listoption.php"); // Redirect after insert
        exit;
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1><?php echo isset($_GET['edit']) ? 'Edit' : 'Add'; ?> Item Option</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active"><?php echo isset($_GET['edit']) ? 'Edit' : 'Add'; ?> Item Option</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'Edit' : 'Add'; ?> Item Option</h5>
                        <form method="POST" enctype="multipart/form-data">
                            <?php if (isset($option)): ?>
                                <h3 class="text-success">Option <?php echo isset($_GET['edit']) ? 'Updated' : 'Inserted'; ?> successfully</h3>
                            <?php endif; ?>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Option Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="option" value="<?php echo $name; ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Image Upload</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="formFile" name="image">
                                    <?php if (isset($image) && !empty($image)): ?>
                                        <img src="../../public/images/<?php echo $image; ?>" width="50px" height="50px" alt="Option Image">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Select Item</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="item" required>
                                        <option value="" selected>Select Item</option>
                                        <?php foreach ($allItems as $item): ?>
                                            <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == $item_id) ? 'selected' : ''; ?>>
                                                <?php echo $item['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Submit Button</label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="submit"><?php echo isset($_GET['edit']) ? 'Update' : 'Add'; ?> Option</button>
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