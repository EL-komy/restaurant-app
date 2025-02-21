<?php
class Table {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Insert a new table
    public function insert($chairs, $available) {
        $insertQuery = "INSERT INTO tables (chairs, available) VALUES (:chairs, :available)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bindParam(':chairs', $chairs, PDO::PARAM_INT);
        $stmt->bindParam(':available', $available, PDO::PARAM_BOOL);
        return $stmt->execute();
    }

    // Select all tables
    public function select() {
        $selectQuery = "SELECT * FROM tables";
        $stmt = $this->conn->prepare($selectQuery);
        $stmt->execute();
        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($tables) {
            return $tables;
        } else {
            echo "No tables found.";
        }
    }

    // Select one table by ID
    public function selectOne($id) {
        $selectQuery = "SELECT * FROM tables WHERE id = :id";
        $stmt = $this->conn->prepare($selectQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $table = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($table) {
            return $table;
        } else {
            echo "Table not found.";
        }
    }

    // Delete a table by ID
    public function delete($id) {
        $deleteQuery = "DELETE FROM tables WHERE id = :id";
        $stmt = $this->conn->prepare($deleteQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Update a table by ID
    public function update($id, $chairs, $available) {
        $updateQuery = "UPDATE tables SET chairs = :chairs, available = :available WHERE id = :id";
        $stmt = $this->conn->prepare($updateQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':chairs', $chairs, PDO::PARAM_INT);
        $stmt->bindParam(':available', $available, PDO::PARAM_BOOL);
        return $stmt->execute();
    }
}
?>