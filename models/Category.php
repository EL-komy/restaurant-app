<?php
class Category {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function insert($ctegory_name){
        $insertQuery="INSERT INTO categories (ctegory_name) VALUES (:ctegory_name)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bindParam(':ctegory_name', $ctegory_name);
        return $stmt->execute();

    }
    public function select(){
        $selectQuery="SELECT * FROM categories";
        $stmt = $this->conn->prepare($selectQuery);
        $stmt->execute();  // FIXED TYPO HERE
        $category = $stmt->fetchAll(PDO::FETCH_ASSOC);  // FIX FETCH METHOD
        if($category){
            return $category;
        }else{
            echo "error";
        }
    }
    public function selectone($id){
        $selectQuery="SELECT * FROM categories WHERE id=:id";
        $stmt = $this->conn->prepare($selectQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();  // FIXED TYPO HERE
        $category = $stmt->fetch(PDO::FETCH_ASSOC);  // FIX FETCH METHOD
        if($category){
            return $category;
        }else{
            echo "error";
        }
    }
    public function delete($id){
        $deleteQuery="DELETE FROM categories WHERE id=:id";
        $stmt = $this->conn->prepare($deleteQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();

    }
    public function update($id,$ctegory_name){
        $updateQuery="UPDATE categories SET ctegory_name=:ctegory_name WHERE id=:id ";
        $stmt = $this->conn->prepare($updateQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':ctegory_name', $ctegory_name);
        return $stmt->execute();
    }
}
?>