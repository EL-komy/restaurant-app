<?php
class Supplier {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Insert a new supplier
    public function insert($supplier_name, $email, $phone) {
        $insertQuery = "INSERT INTO suppliers (supplier_name, email, phone) VALUES (:supplier_name, :email, :phone)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bindParam(':supplier_name', $supplier_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        return $stmt->execute();
    }

    // Select all suppliers
    public function select() {
        $selectQuery = "SELECT * FROM suppliers";
        $stmt = $this->conn->prepare($selectQuery);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Select one supplier by ID
    public function selectOne($id) {
        $selectQuery = "SELECT * FROM suppliers WHERE id = :id";
        $stmt = $this->conn->prepare($selectQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Delete a supplier by ID
    public function delete($id) {
        $deleteQuery = "DELETE FROM suppliers WHERE id = :id";
        $stmt = $this->conn->prepare($deleteQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Update a supplier by ID
    public function update($id, $supplier_name, $email, $phone) {
        $updateQuery = "UPDATE suppliers SET supplier_name = :supplier_name, email = :email, phone = :phone WHERE id = :id";
        $stmt = $this->conn->prepare($updateQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':supplier_name', $supplier_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        return $stmt->execute();
    }
}
?>