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
    public function select(){
        $option=$this->options->select();
        return $option;

    }
    public function delete($id){
        $item=$this->options->delete($id);
        if($item){
            return true;
        }else{return false;}
    }
    public function update($id, $item_id, $name, $image = null)
{
    // Call the update method for the item_options table
    $itemOption = $this->options->update($id, $item_id, $name, $image);

    // Check if the update was successful
    if (!$itemOption) {
        echo "error";
    } else {
        echo "success";
    }
}
public function selectone($id){
    $item=$this->options->selectone($id);
    return $item;
}
}
?>