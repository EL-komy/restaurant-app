<?php
class Options {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insert($item_id, $name, $image) {
        $insertQuery = "INSERT INTO item_options (item_id, name, image) VALUES (:item, :name, :image)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bindParam(':item', $item_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }
}
?>