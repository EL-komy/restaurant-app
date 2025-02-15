<?php
require_once '../../models/Options.php';
require_once '../../config/db.php';

class OptionsController {
    private $db;
    private $options;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->options = new Options($this->db);
    }

    public function insert($item_id, $name, $image) {
        // Validate inputs
        if (empty($item_id) || empty($name) || empty($image)) {
            throw new Exception("All fields are required.");
        }

        // Call the model's insert method
        return $this->options->insert($item_id, $name, $image);
    }
}
?>