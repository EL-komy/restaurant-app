<?php
require_once '../../models/Supplier.php';
require_once '../../config/db.php';

class SupplierController {
    private $db;
    private $supplier;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->supplier = new Supplier($this->db);
    }

    // Insert a new supplier
    public function insert($supplier_name, $email, $phone) {
        return $this->supplier->insert($supplier_name, $email, $phone);
    }

    // Select all suppliers
    public function select() {
        return $this->supplier->select();
    }

    // Select one supplier by ID
    public function selectOne($id) {
        return $this->supplier->selectOne($id);
    }

    // Delete a supplier by ID
    public function delete($id) {
        return $this->supplier->delete($id);
    }

    // Update a supplier by ID
    public function update($id, $supplier_name, $email, $phone) {
        return $this->supplier->update($id, $supplier_name, $email, $phone);
    }
}
?>