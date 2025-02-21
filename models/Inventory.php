<?php
class Inventory {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Insert a new inventory item
    public function insert($item_name, $quantity, $supplier_id) {
        $insertQuery = "INSERT INTO inventory (item_name, quantity, supplier_id) VALUES (:item_name, :quantity, :supplier_id)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bindParam(':item_name', $item_name);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':supplier_id', $supplier_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Select all inventory items with supplier name
    public function select() {
        $selectQuery = "
            SELECT inventory.*, suppliers.supplier_name 
            FROM inventory 
            LEFT JOIN suppliers ON inventory.supplier_id = suppliers.id
        ";
        $stmt = $this->conn->prepare($selectQuery);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Select one inventory item by ID with supplier name
    public function selectOne($id) {
        $selectQuery = "
            SELECT inventory.*, suppliers.supplier_name 
            FROM inventory 
            LEFT JOIN suppliers ON inventory.supplier_id = suppliers.id 
            WHERE inventory.id = :id
        ";
        $stmt = $this->conn->prepare($selectQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Delete an inventory item by ID
    public function delete($id) {
        $deleteQuery = "DELETE FROM inventory WHERE id = :id";
        $stmt = $this->conn->prepare($deleteQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Update an inventory item by ID
    public function update($id, $item_name, $quantity, $supplier_id) {
        $updateQuery = "UPDATE inventory SET item_name = :item_name, quantity = :quantity, supplier_id = :supplier_id WHERE id = :id";
        $stmt = $this->conn->prepare($updateQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':item_name', $item_name);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':supplier_id', $supplier_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
