<?php
require_once '../../models/ItemContent.php';
require_once '../../config/db.php';

class ItemContentController {
    private $db;
    private $itemContent;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->itemContent = new ItemContent($this->db);
    }

    // Insert a new item content record
    public function insert($item_id, $inventory_id) {
        return $this->itemContent->insert($item_id, $inventory_id);
    }

    // Select all item content records
    public function select() {
        return $this->itemContent->select();
    }

    // Select one item content record by ID
    public function selectOne($id) {
        return $this->itemContent->selectOne($id);
    }

    // Delete an item content record by ID
    public function delete($id) {
        return $this->itemContent->delete($id);
    }

    // Update an item content record by ID
    public function update($id, $item_id, $inventory_id) {
        return $this->itemContent->update($id, $item_id, $inventory_id);
    }
}
?>