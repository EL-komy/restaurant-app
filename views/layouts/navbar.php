<link rel="stylesheet" href="/public/css/index.css">
<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="./public/images/logo2.jpg" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="index.php"> <i class="bi bi-check-lg"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="./views/shared/userinfo.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="views/customer/menu.php">Menu</a>
                    </li>
                   </ul>
                <i class="bi bi-cart cart-icon"></i>
                <?php if (isset($_SESSION['email'])): ?>
                <a href="config\logout.php" class="btn btn-danger">Log Out</a>
            <?php else: ?>
                <a href=".\views\shared\login.php" class="btn btn-danger">Log In</a>
            <?php endif; ?>
            </div>
        </div>
    </nav>
