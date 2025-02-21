<?php
class reservation
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function reserve($user_id, $user_name, $table_id, $reservation_date, $reservationtime , $guest)
    {
        $stmt = $this->conn->prepare("SELECT r.id, u.name AS user_name, t.id AS table_id, r.reservation_date, r.reservation_time, r.guests 
        FROM reservation r 
        JOIN users u ON r.user_id = u.id 
        JOIN tables t ON r.table_id = t.id");

$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}



