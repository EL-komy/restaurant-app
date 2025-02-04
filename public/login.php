<?php
session_start();

$users = [
    "user@example.com" => ["password" => "123456", "name" => "John Doe", "role" => "customer"],
    "admin@example.com" => ["password" => "admin123", "name" => "Admin User", "role" => "staff"]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $remember = isset($_POST["remember"]);


    if (isset($users[$email]) && $users[$email]["password"] === $password) {
        $_SESSION["user_id"] = $email;
        $_SESSION["user_name"] = $users[$email]["name"];
        $_SESSION["user_role"] = $users[$email]["role"];

        // Set remember me cookie
        if ($remember) {
            setcookie("email", $email, time() + (30 * 24 * 60 * 60), "/");
        } else {
            setcookie("email", "", time() - 3600, "/"); // Delete cookie
        }

        // Redirect to website home page
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<h2>Login</h2>


<form action="" method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>" required>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <input type="checkbox" name="remember" id="remember">
    <label for="remember">Remember Me</label>

    <button type="submit">Login</button>
</form>

</body>
</html>
