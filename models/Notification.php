<?php

class Notification
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

   


    public function insert($user_id, $message) {
        $query = "INSERT INTO notifications (user_id, message, created_at) VALUES (:user_id, :message, NOW())";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':message', $message);
        
        return $stmt->execute();
    }

    public function select($user_id) {
        $query = "SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function selectAll()
    {
        $query = "SELECT * FROM notifications";
        $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function markAsRead($id) {
        $stmt = $this->conn->prepare("UPDATE notifications SET is_read = 1 WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function selectUnreadCount($user_id) {
        $query = "SELECT COUNT(*) as unread_count FROM notifications WHERE user_id = :user_id AND is_read = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC)['unread_count'];
    }

}
