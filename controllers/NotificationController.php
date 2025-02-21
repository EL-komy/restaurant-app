<?php
require_once '../../models/Notification.php';
require_once '../../config/db.php';

class NotificationController {
    private $db;
    private $item;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->item = new Notification($this->db);
    }

    public function addNotification($user_id, $message) {
        $notification = $this->item->insert($user_id, $message);
        if (!$notification) {
            echo "Error adding notification.";
        } else {
            echo "Notification added successfully.";
        }
    }

    public function selectAll($id) {
        $notifications = $this->item->selectAll($id);
        return $notifications; // Return the notifications for further processing
    }

    public function markNotificationAsRead($id) {
        return $this->item->markAsRead($id);
    }

    public function getUnreadCount($user_id) {
        return $this->item->selectUnreadCount($user_id);
    }

}
?>