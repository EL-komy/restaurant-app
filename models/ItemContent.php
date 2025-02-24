<?php
class ItemContent {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Insert a new item content record
    public function insert($item_id, $inventory_id) {
        $insertQuery = "INSERT INTO itemcontent (item_id, inventory_id) VALUES (:item_id, :inventory_id)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
        $stmt->bindParam(':inventory_id', $inventory_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Select all item content records
    public function select() {
        $selectQuery = "
            SELECT itemcontent.*, menu_items.name AS item_name, inventory.item_name AS inventory_name
            FROM itemcontent
            LEFT JOIN menu_items ON itemcontent.item_id = menu_items.id
            LEFT JOIN inventory ON itemcontent.inventory_id = inventory.id
        ";
        $stmt = $this->conn->prepare($selectQuery);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Select one item content record by ID
    public function selectOne($id) {
        $selectQuery = "
            SELECT itemcontent.*, menu_items.name AS item_name, inventory.item_name AS inventory_name
            FROM itemcontent
            LEFT JOIN menu_items ON itemcontent.item_id = menu_items.id
            LEFT JOIN inventory ON itemcontent.inventory_id = inventory.id
            WHERE itemcontent.id = :id
        ";
        $stmt = $this->conn->prepare($selectQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Delete an item content record by ID
    public function delete($id) {
        $deleteQuery = "DELETE FROM itemcontent WHERE id = :id";
        $stmt = $this->conn->prepare($deleteQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Update an item content record by ID
    public function update($id, $item_id, $inventory_id) {
        $updateQuery = "UPDATE itemcontent SET item_id = :item_id, inventory_id = :inventory_id WHERE id = :id";
        $stmt = $this->conn->prepare($updateQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
        $stmt->bindParam(':inventory_id', $inventory_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>