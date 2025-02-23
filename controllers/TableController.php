<?php
require_once '../../models/Table.php';
require_once '../../config/db.php';

class TableController {
    private $db;
    private $table;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->table = new Table($this->db);
    }

    // Insert a new table
    public function insert($chairs, $available) {
        $result = $this->table->insert($chairs, $available);
        if (!$result) {
            echo "error";
        } else {
            echo "success";
        }
    }

    // Select all tables
    public function select() {
        $tables = $this->table->select();
        return $tables;
    }

    // Select one table by ID
    public function selectOne($id) {
        $table = $this->table->selectOne($id);
        return $table;
    }

    // Delete a table by ID
    public function delete($id) {
        $result = $this->table->delete($id);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Update a table by ID
    public function update($id, $chairs, $available) {
        $result = $this->table->update($id, $chairs, $available);
        if (!$result) {
            echo "error";
        } else {
            echo "success";
        }
    }
}
?>