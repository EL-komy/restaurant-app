<?php
session_start();
require_once "../../config/db.php";

$database = new Database();
$pdo = $database->connect();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION["user_id"] ?? 1;
    $guests = $_POST["guests"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    if ($guests <= 0) {
        header("Location: error.php?msg=invalid_guests");
        exit();
    }

    
    $checkDuplicate = $pdo->prepare("
        SELECT * FROM reservation 
        WHERE user_id = ? AND reservation_date = ? AND reservation_time = ?
    ");
    $checkDuplicate->execute([$user_id, $date, $time]);
    $existingReservation = $checkDuplicate->fetch(PDO::FETCH_ASSOC);

    if ($existingReservation) {
        header("Location: error.php?msg=already_reserved");
        exit();
    }

    
    $stmt = $pdo->prepare("
        SELECT * FROM tables t
        WHERE t.chairs >= ? 
        AND t.id NOT IN (
            SELECT r.table_id FROM reservation r 
            WHERE r.reservation_date = ? 
            AND r.reservation_time = ?
        )
        LIMIT 1
    ");
    $stmt->execute([$guests, $date, $time]);
    $table = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$table) {
        header("Location: error.php?msg=no_table");
        exit();
    }

    
    $stmt = $pdo->prepare("INSERT INTO reservation (user_id, table_id, reservation_date, reservation_time, guests, table_status) 
                           VALUES (?, ?, ?, ?, ?, 0)");
    $stmt->execute([$user_id, $table["id"], $date, $time, $guests]);

    
    $stmt = $pdo->prepare("UPDATE tables SET available = 1 WHERE id = ?");
    $stmt->execute([$table["id"]]);

    
    header("Location: success.php");
    exit();
} else {
    header("Location: error.php?msg=invalid_request");
    exit();
}
?>

