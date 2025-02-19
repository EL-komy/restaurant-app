<?php
require_once '../../models/Menu.php';
require_once '../../config/db.php';

class MenuController {
    private $db;
    private $item;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->item = new Menu($this->db);
    }
    public function insert($name,$category_id,$description,$price,$image){
        $item=$this->item->insert($name,$category_id,$description,$price,$image);
        if(!$item){
            echo "error";
        }
        else{
            echo "success";
        }
    }

    public function insertOffer($id, $price, $expiry_date){
        $item=$this->item->insertOffer($id, $price, $expiry_date);
        if(!$item){
            echo "error";
        }
        else{
            echo "success";
        }
    }
    public function select(){
        $item=$this->item->select();
        // var_export($item);
        return $item;
    }

    
    public function selectone($id){
        $item=$this->item->selectone($id);
        return $item;
    }
    public function delete($id){
        $item=$this->item->delete($id);
        if($item){
            return true;
        }else{return false;}
    }

    public function update($id, $name, $cat_name, $description, $price,$available,$image){
        

        $item=$this->item->update($id, $name, $cat_name, $description, $price,$available,$image);
        if(!$item){
            echo "error";
        }
        else{
            echo "success";
        }
    }
}
?>