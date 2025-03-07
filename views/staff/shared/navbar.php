<?php
session_start();
require_once '../../controllers/NotificationController.php';
require_once "../../controllers/CustomerController.php";

$email = $_SESSION['email'];

if ($email) {
  $controller = new CustomerController();
  $user = $controller->select($email);
} else {
  header("Location:../shared/login.php");
}

$notificationController = new NotificationController();

$notifications = $notificationController->selectAll($user['id']);
$notificationCount = count($notifications); 

$unreadCount = $notificationController->getUnreadCount($user['id']); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['noti'])  && isset($_POST['notification_id'])) {
    $notificationId = $_POST['notification_id'];
    $notificationController->markNotificationAsRead($notificationId);
   
    $notifications = $notificationController->selectAll($user['id']);
    $unreadCount = $notificationController->getUnreadCount($user['id']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>FRYCO DASH BOARD</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>



  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="../../../index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">FRYCO ADMIN</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?=$user['user_name']?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?=$user['user_name']?></h6>
              <span>Fryco Admin</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            
           
            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number"><?= $unreadCount ?></span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have <?= $unreadCount ?> new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <?php foreach ($notifications as $notification): ?>
              <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                  <h4><?= htmlspecialchars($notification['message']) ?></h4>
                  <p><?= htmlspecialchars($notification['created_at']) ?></p>
                </div>
                <?php if ($notification['is_read']): // Check if the notification is read ?>
                  <span class="text-muted">Read</span>
                <?php else: ?>
                  <form method="POST" action="">
                    <input type="hidden" name="notification_id" value="<?= $notification['id'] ?>">
                    <button name="noti" type="submit" class="btn btn-link">Mark as read</button>
                  </form>
                <?php endif; ?>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
            <?php endforeach; ?>
          </ul>
        </li>
      </ul>
    </nav>
  </header>
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <!-- Users -->
        <li class="nav-item">
            <a class="nav-link" href="users.php">
                <i class="ri-account-pin-circle-fill"></i>
                <span>Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="listorders.php">
                <i class="ri-account-pin-circle-fill"></i>
                <span>Orders</span>
            </a>
        </li>

        <!-- Categories -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#categories-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="categories-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="category.php">
                        <i class="bi bi-circle"></i><span>Add Category</span>
                    </a>
                </li>
                <li>
                    <a href="listcategory.php">
                        <i class="bi bi-circle"></i><span>List Categories</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Tables -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="addtable.php">
                        <i class="bi bi-circle"></i><span>Add Table</span>
                    </a>
                </li>
                <li>
                    <a href="listtables.php">
                        <i class="bi bi-circle"></i><span>List Tables</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Suppliers -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#suppliers-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Suppliers</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="suppliers-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="addsupplier.php">
                        <i class="bi bi-circle"></i><span>Add Supplier</span>
                    </a>
                </li>
                <li>
                    <a href="listsuppliers.php">
                        <i class="bi bi-circle"></i><span>List Suppliers</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Inventory -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#inventory-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Inventory</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="inventory-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="addinventory.php">
                        <i class="bi bi-circle"></i><span>Add Inventory</span>
                    </a>
                </li>
                <li>
                    <a href="listinventory.php">
                        <i class="bi bi-circle"></i><span>List Inventory</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Menu Items -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#menu-items-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Menu Items</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menu-items-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="additem.php">
                        <i class="bi bi-circle"></i><span>Add Menu Item</span>
                    </a>
                </li>
                <li>
                    <a href="listitems.php">
                        <i class="bi bi-circle"></i><span>List Menu Items</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Item Content -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#item-content-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Item Content</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="item-content-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="additemcontent.php">
                        <i class="bi bi-circle"></i><span>Add Item Content</span>
                    </a>
                </li>
                <li>
                    <a href="listitemcontent.php">
                        <i class="bi bi-circle"></i><span>List Item Content</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Item Options -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#item-options-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Item Options</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="item-options-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="addoption.php">
                        <i class="bi bi-circle"></i><span>Add Option</span>
                    </a>
                </li>
                <li>
                    <a href="listoption.php">
                        <i class="bi bi-circle"></i><span>List Options</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Profile -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="admin.php">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

    </ul>
</aside><!-- End Sidebar -->
