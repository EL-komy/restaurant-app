<?php
require_once '../../config/db.php';


$database = new Database();
$conn = $database->connect();


try {
    $sql = "SELECT * FROM item_options WHERE item_id = :item_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':item_id', $item['item_id'], PDO::PARAM_INT);
    $stmt->execute();
    $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}

?>

<form action="cart.php" method="POST">
<div class="modal fade" id="exampleModal<?= $item['item_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customize Your Meal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container my-5 customize-container">
                    <h2 class="text-center mb-4 text-danger">Customize Your Meal</h2>
                    <div class="row">
                        <!-- Sidebar -->
                        <div class="col-lg-3 sidebar">
                            <a href="#sandwich-section" class="active">Select Your Favorite Cheese</a>
                            <a href="#side-item-section">Select Your Favorite Extra Tomato</a>
                            <a href="#addon-section">Select Your Drink</a>
                        </div>

                            <div class="col-lg-5">
                                <div id="sandwich-section" class="mb-5">
                                    <h5 class="text-danger">Select Your Favorite Extra Cheese</h5>
                                    <?php foreach ($options as $option): ?>
                                        <?php if ($option['item_id'] == 1): ?>
                                            <div class="my-3 p-2 border rounded">
                                                <div class="d-flex align-items-center">
                                                    <img src="../../public/images/images (4).jpg" alt="" width="60" class="me-2">
                                                    <strong><?php echo htmlspecialchars($option['name']); ?></strong>
                                                </div>
                                                <div class="mt-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="cheese" value="none" checked>
                                                        <label class="form-check-label">None</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="cheese" value="regular">
                                                        <label class="form-check-label">Regular</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="cheese" value="extra">
                                                        <label class="form-check-label">Extra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>

                                <div id="side-item-section" class="mb-5">
                                    <h5 class="text-danger">Select Your Favorite Extra Tomato</h5>
                                    <?php foreach ($options as $option): ?>
                                        <?php if ($option['item_id'] == 2): ?>
                                            <div class="my-3 p-2 border rounded">
                                                <div class="d-flex align-items-center">
                                                    <img src="../../public/images/Tomato_je.jpg" alt="" width="60" class="me-2">
                                                    <strong>Tomato</strong>
                                                </div>
                                                <div class="mt-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="tomato" value="none" checked>
                                                        <label class="form-check-label">None</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="tomato" value="regular">
                                                        <label class="form-check-label">Regular</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="tomato" value="extra">
                                                        <label class="form-check-label">Extra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>

                                <div id="addon-section" class="mb-5">
                                    <h5 class="text-danger">Drinks</h5>
                                    <?php foreach ($options as $option): ?>
                                        <?php if ($option['item_id'] == 3): ?>
                                            <div class="my-3 p-2 border rounded">
                                                <div class="d-flex align-items-center">
                                                    <img src="../../public/images/mirinda-orange-can-drink-250ml-nazar-jan-s-supermarket-1_large.webp" alt="" width="60" class="me-2">
                                                    <strong>Mirinda</strong>
                                                </div>
                                                <div class="mt-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="drink" value="none" checked>
                                                        <label class="form-check-label">None</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="drink" value="coke">
                                                        <label class="form-check-label">Regular</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="drink" value="mirinda">
                                                        <label class="form-check-label">Extra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>



                            </div>

                        <!-- Selected Item Summary -->
                        <div class="col-lg-4 selected-item">
                            <img src="../../public/images/Sargento11501.jpg" class="img-fluid" alt="Zinger Crunch" />
                            <h4 class="mt-3 text-danger">Zinger Crunch</h4>
                            <p class="text-muted">Zinger + Kantook + Coleslaw</p>
                            <h3 class="text-danger">125.00 EGP</h3>
                            <p class="text-muted">* All prices are VAT inclusive</p>
                            <button type="reset" class="btn btn-reset btn-sm mb-3">RESET</button>
                            <button type="submit" class="btn btn-add-to-cart w-100">Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</form>

