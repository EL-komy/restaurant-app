<?php
require_once '../../models/Options.php';
require_once '../../config/db.php';

class OptionsController{
    private $db;
    private $category;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->options = new Options($this->db);
    }
    public function insert($item_id,$name,$image){
        

    }
}
?>