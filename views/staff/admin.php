<?php
session_start(); // Ensure this is at the very top

require_once "shared/navbar.php";

if (!isset($_SESSION['email'])) {
    header("Location: ../shared/login.php");
    exit();
}

require_once '../../config/db.php';
require_once '../../models/User.php';

$database = new Database();
$db = $database->connect();
$userModel = new User($db);
$user = $userModel->select($_SESSION['email']);

if (!$user) {
    die("User not found in the database.");
}

$id = $user['id'];
$name = $user['user_name'];
$email = $user['email'];
$phone = $user['phone'];
$address = $user['addresss'];
$message = "";

// Handle profile update
if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $userupdate = $userModel->updateAdmin($id, $name, $email, $address, $phone);

    if ($userupdate) {
        $message = "<h3 class='text-success'>Admin Updated successfully</h3>";
        $user = $userModel->select($_SESSION['email']); // Refresh user data
    } else {
        $message = "<h3 class='text-danger'>Admin update failed</h3>";
    }
}

// Handle password change
if (isset($_POST['change_password'])) {
    $currentPassword = $_POST['password'];
    $newPassword = $_POST['newpassword'];
    $renewPassword = $_POST['renewpassword'];

    if (empty($currentPassword) || empty($newPassword) || empty($renewPassword)) {
        $message = "<h3 class='text-danger'>All fields are required.</h3>";
    } elseif (!password_verify($currentPassword, $user['passwordd'])) {
        $message = "<h3 class='text-danger'>Current password is incorrect.</h3>";
    } elseif ($newPassword !== $renewPassword) {
        $message = "<h3 class='text-danger'>New passwords do not match.</h3>";
    } elseif (strlen($newPassword) < 6) {
        $message = "<h3 class='text-danger'>New password must be at least 6 characters.</h3>";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        if ($userModel->updatePassword($id, $hashedPassword)) {
            $message = "<h3 class='text-success'>Password changed successfully.</h3>";
        } else {
            $message = "<h3 class='text-danger'>Failed to change password.</h3>";
        }
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav></nav>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <h2><?= htmlspecialchars($user['user_name']); ?></h2>
                        <h3>Fryco Admin</h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>
                        </ul>

                        <div class="tab-content pt-2">
                            <!-- Profile Overview Tab -->
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>
                                <div class="row"><div class="col-lg-3 col-md-4 label">Name</div><div class="col-lg-9 col-md-8"><?= htmlspecialchars($user['user_name']); ?></div></div>
                                <div class="row"><div class="col-lg-3 col-md-4 label">Address</div><div class="col-lg-9 col-md-8"><?= htmlspecialchars($user['addresss']); ?></div></div>
                                <div class="row"><div class="col-lg-3 col-md-4 label">Phone</div><div class="col-lg-9 col-md-8"><?= htmlspecialchars($user['phone']); ?></div></div>
                                <div class="row"><div class="col-lg-3 col-md-4 label">Email</div><div class="col-lg-9 col-md-8"><?= htmlspecialchars($user['email']); ?></div></div>
                            </div>

                            <!-- Profile Edit Tab -->
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <form method="post">
                                    <div class="row mb-3"><label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label><div class="col-md-8 col-lg-9"><input name="name" type="text" class="form-control" id="fullName" value="<?= htmlspecialchars($name); ?>"></div></div>
                                    <div class="row mb-3"><label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label><div class="col-md-8 col-lg-9"><input name="address" type="text" class="form-control" id="Address" value="<?= htmlspecialchars($address); ?>"></div></div>
                                    <div class="row mb-3"><label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label><div class="col-md-8 col-lg-9"><input name="phone" type="text" class="form-control" id="Phone" value="<?= htmlspecialchars($phone); ?>"></div></div>
                                    <div class="row mb-3"><label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label><div class="col-md-8 col-lg-9"><input name="email" type="email" class="form-control" id="Email" value="<?= htmlspecialchars($email); ?>"></div></div>
                                    <div class="text-center"><button type="submit" class="btn btn-primary" name="edit">Save Changes</button></div>
                                </form>
                            </div>

                            <!-- Change Password Tab -->
                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <?= $message; ?>
                                <form method="post">
                                    <div class="row mb-3"><label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label><div class="col-md-8 col-lg-9"><input name="password" type="password" class="form-control" id="currentPassword" required></div></div>
                                    <div class="row mb-3"><label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label><div class="col-md-8 col-lg-9"><input name="newpassword" type="password" class="form-control" id="newPassword" required></div></div>
                                    <div class="row mb-3"><label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label><div class="col-md-8 col-lg-9"><input name="renewpassword" type="password" class="form-control" id="renewPassword" required></div></div>
                                    <div class="text-center"><button type="submit" class="btn btn-primary" name="change_password">Change Password</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once "shared/footer.php"; ?>
