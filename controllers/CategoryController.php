<?php
require_once '../../models/Category.php';
require_once '../../config/db.php';

class CategoryController {
    private $db;
    private $category;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->category = new Category($this->db);
    }
    public function insert($name){
        $category=$this->category->insert($name);
        if(!$category){
            echo "error";
        }
        else{
            echo "success";
        }
    }
    public function select(){
        $category=$this->category->select();
        return $category;

    }
    public function selectone($id){
        $category=$this->category->selectone($id);
        return $category;
    }
    public function delete($id){
        $category=$this->category->delete($id);
        if($category){
            return true;
        }else{return false;}
    }

    public function update($id,$ctegory_name){

        $category=$this->category->update($id,$ctegory_name);
        if(!$category){
            echo "error";
        }
        else{
            echo "success";
        }
    }
}
?>