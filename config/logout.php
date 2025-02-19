<?php
session_start();
session_unset();
session_destroy();
header("Location: ../views/shared/login.php");
exit();
?>

