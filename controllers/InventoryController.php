<?php
require_once '../../models/Inventory.php';
require_once '../../config/db.php';

class InventoryController {
    private $db;
    private $inventory;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->inventory = new Inventory($this->db);
    }

    // Insert a new inventory item
    public function insert($item_name, $quantity, $supplier_id) {
        return $this->inventory->insert($item_name, $quantity, $supplier_id);
    }

    // Select all inventory items
    public function select() {
        return $this->inventory->select();
    }

    // Select one inventory item by ID
    public function selectOne($id) {
        return $this->inventory->selectOne($id);
    }

    // Delete an inventory item by ID
    public function delete($id) {
        return $this->inventory->delete($id);
    }

    // Update an inventory item by ID
    public function update($id, $item_name, $quantity, $supplier_id) {
        return $this->inventory->update($id, $item_name, $quantity, $supplier_id);
    }
}
?>