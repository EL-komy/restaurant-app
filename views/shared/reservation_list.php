<?php
require_once "../../config/db.php";

$database = new Database(); 

$pdo = $database->connect(); 

$stmt = $pdo->query("SELECT r.id, u.user_name AS user_name, t.id AS table_id, r.reservation_date, r.reservation_time, r.guests
FROM reservation r
JOIN users u ON r.id = u.id
JOIN tables t ON r.table_id = t.id
");

$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> menu reservation </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center"> reservation menu </h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>user name </th>
                <th> table number </th>
                <th> date </th>
                <th> time </th>
                <th> number of guests </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $reservation) : ?>
                <tr>
                    <td><?= $reservation["id"] ?></td>
                    <td><?= htmlspecialchars($reservation["user_name"]) ?></td>
                    <td><?= $reservation["table_id"] ?></td>
                    <td><?= $reservation["reservation_date"] ?></td>
                    <td><?= $reservation["reservation_time"] ?></td>
                    <td><?= $reservation["guests"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
