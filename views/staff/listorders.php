<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../shared/login.php");
    exit();
}

require_once '../../config/db.php';

$database = new Database();
$db = $database->connect();

// Check if the user is an admin
$email = $_SESSION['email'];
$stmt = $db->prepare("SELECT rolee FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user['rolee'] != 2) { // Assuming rolee is the column name for role in your database
    header("Location: error.php");
    exit();
}

require_once "shared/navbar.php";

// Handle order deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $db->prepare("DELETE FROM orders WHERE id = :id");
    $stmt->execute(['id' => $id]);
    header("Location: listorders.php"); // Redirect to refresh the page
    exit();
}

// Handle order status update
if (isset($_GET['update_order_status'])) {
    $id = $_GET['update_order_status'];
    $status = $_GET['status'];
    $stmt = $db->prepare("UPDATE orders SET status = :status WHERE id = :id");
    $stmt->execute(['status' => $status, 'id' => $id]);
    // header("Location: listorders.php"); // Redirect to refresh the page
    // exit();
}

// Handle payment status update
if (isset($_GET['update_payment_status'])) {
    $id = $_GET['update_payment_status'];
    $status = $_GET['status'];
    $stmt = $db->prepare("UPDATE payments SET status = :status WHERE order_id = :id");
    $stmt->execute(['status' => $status, 'id' => $id]);
    // header("Location: listorders.php"); // Redirect to refresh the page
    // exit();
}

// Fetch all orders with user, order item, and payment details
$query = "
    SELECT 
        o.id AS order_id,
        o.status AS order_status,
        o.total_price,
        o.created_at,
        u.id AS user_id,
        u.user_name,
        u.email,
        od.item_id,
        od.quantity,
        od.price AS item_price,
        mi.name AS item_name,
        oo.customizations,
        p.payment_method,
        p.status AS payment_status
    FROM 
        orders o
    JOIN 
        users u ON o.user_id = u.id
    JOIN 
        order_details od ON o.id = od.order_id
    JOIN 
        menu_items mi ON od.item_id = mi.id
    JOIN 
        payments p ON o.id = p.order_id
    join 
        order_options oo on o.id = oo.order_id
    ORDER BY 
        o.created_at DESC
";
$stmt = $db->query($query);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Group orders by order ID for easier display
$groupedOrders = [];
foreach ($orders as $order) {
    $orderId = $order['order_id'];
    if (!isset($groupedOrders[$orderId])) {
        $groupedOrders[$orderId] = [
            'order_id' => $order['order_id'],
            'order_status' => $order['order_status'],
            'total_price' => $order['total_price'],
            'created_at' => $order['created_at'],
            'user_name' => $order['user_name'],
            'email' => $order['email'],
            'payment_method' => $order['payment_method'],
            'payment_status' => $order['payment_status'],
            'items' => [],
            'options' => []
        ];
    }
    $groupedOrders[$orderId]['items'][] = [
        'item_name' => $order['item_name'],
        'customizations' => $order['customizations'],
        'quantity' => $order['quantity'],
        'item_price' => $order['item_price']
    ];
    $groupedOrders[$orderId]['options'][] = [
        'item_name' => $order['item_name'],
        'customizations' => $order['customizations'],
        // 'quantity' => $order['quantity'],
        // 'item_price' => $order['item_price']
    ];
}
?>

<?php if ($user['rolee'] == 2): ?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Orders</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active">Orders</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Orders List</h5>

          <table class="table datatable">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Order Items</th>
                <th>Order options</th>
                <th>Total Price</th>
                <th>Order Status</th>
                <th>Payment Status</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($groupedOrders as $order): ?>
                <tr>
                    <td><?= $order['order_id'] ?></td>
                    <td><?= $order['user_name'] ?></td>
                    <td><?= $order['email'] ?></td>
                    <td>
                        <ul>
                            <?php foreach ($order['items'] as $item): ?>
                                <li><?= $item['item_name'] ?> (Qty: <?= $item['quantity'] ?>, Price: $<?= $item['item_price'] ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td>
                    <ul>
                            <?php foreach ($order['options'] as $item): ?>
                                <li><?= $item['item_name'] ?> (option: <?= $item['customizations'] ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td>$<?= $order['total_price'] ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="?update_order_status=<?= $order['order_id'] ?>&status=pending" class="btn btn-sm <?= $order['order_status'] == 'pending' ? 'btn-primary' : 'btn-outline-primary' ?>">Pending</a>
                            <a href="?update_order_status=<?= $order['order_id'] ?>&status=preparing" class="btn btn-sm <?= $order['order_status'] == 'preparing' ? 'btn-warning' : 'btn-outline-warning' ?>">Preparing</a>
                            <a href="?update_order_status=<?= $order['order_id'] ?>&status=Ready" class="btn btn-sm <?= $order['order_status'] == 'Ready' ? 'btn-success' : 'btn-outline-success' ?>">Ready</a>
                            <a href="?update_order_status=<?= $order['order_id'] ?>&status=Delivered" class="btn btn-sm <?= $order['order_status'] == 'Delivered' ? 'btn-info' : 'btn-outline-info' ?>">Delivered</a>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="?update_payment_status=<?= $order['order_id'] ?>&status=pending" class="btn btn-sm <?= $order['payment_status'] == 'pending' ? 'btn-primary' : 'btn-outline-primary' ?>">Pending</a>
                            <a href="?update_payment_status=<?= $order['order_id'] ?>&status=completed" class="btn btn-sm <?= $order['payment_status'] == 'completed' ? 'btn-success' : 'btn-outline-success' ?>">Completed</a>
                            <a href="?update_payment_status=<?= $order['order_id'] ?>&status=failed" class="btn btn-sm <?= $order['payment_status'] == 'failed' ? 'btn-danger' : 'btn-outline-danger' ?>">Failed</a>
                        </div>
                    </td>
                    <td><?= $order['created_at'] ?></td>
                    <td>
                        <a href="?delete=<?= $order['order_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
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