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
        die("the number of guests is not valid");
    }

    
    $stmt = $pdo->prepare("
    SELECT * FROM tables t
    WHERE t.chairs >= ? 
    AND t.id NOT IN (
        SELECT r.table_id FROM reservation r 
        WHERE r.reservation_date = ? AND r.reservation_time = ?
    )
    LIMIT 1
");
    $stmt->execute([$guests, $date, $time]);
    $table = $stmt->fetch();



    if (!$table) {
        die("there is no tables available for this number of guests");
    }

   
    $stmt = $pdo->prepare("INSERT INTO reservation (user_id, table_id, reservation_date, reservation_time, guests, table_status) 
                           VALUES (?, ?, ?, ?, ?, 0)");
    $stmt->execute([$user_id, $table["id"], $date, $time, $guests]);

   
    $stmt = $pdo->prepare("UPDATE tables SET available = 1 WHERE id = ?");
    $stmt->execute([$table["id"]]);

    header("Location: reservation_list.php");
    exit();

    echo "reservation success !";
} else {
    echo "request is not valid";
}
?>


