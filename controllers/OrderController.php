<?php
require_once '../../models/Order.php';
require_once '../../config/db.php';

class OrderController {
    private $db;
    private $item;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->item = new Order($this->db);
    }

    public function insertOrder($user_id,$status,$total_price){
        $item=$this->item->insertOrder($user_id,$status,$total_price);
        if(!$item){
            echo "error";
        }
        else{
            echo "success";
        }
    }

    public function insertItem($order_id,$item_id,$quantity,$price){
        $item=$this->item->insertItem($order_id,$item_id,$quantity,$price);
        if(!$item){
            echo "error";
        }
        else{
            echo "success";
        }
    }

    public function totalSales(){
        $item=$this->item->totalSales();
        return $item;
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

    
    public function selectOneOrder($user_id){
        $item=$this->item->selectOneOrder($user_id);
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