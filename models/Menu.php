<?php
class Menu
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function insert($name, $category_id, $description, $price, $image)
    {
        $insertQuery = "INSERT INTO menu_items (name,category_id,description,price,image) VALUES
         (:name,:category_id,:description,:price,:image)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }
    // public function select(){
    //     $selectQuery="SELECT * FROM menu_items";
    //     $stmt = $this->conn->prepare($selectQuery);
    //     $stmt->execute();  // FIXED TYPO HERE
    //     $item = $stmt->fetchAll(PDO::FETCH_ASSOC);  // FIX FETCH METHOD
    //     if($item){
    //         return $item;
    //     }else{
    //         echo "error";
    //     }
    // }
    public function selectone($id)
    {
        $selectQuery = "SELECT * FROM categories c 
        join menu_items m on c.id=m.category_id WHERE m.id=:id";
        $stmt = $this->conn->prepare($selectQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();  // FIXED TYPO HERE
        $item = $stmt->fetch(PDO::FETCH_ASSOC);  // FIX FETCH METHOD
        if ($item) {
            return $item;
        } else {
            echo "error";
        }
    }
    public function delete($id)
    {
        $deleteQuery = "DELETE FROM menu_items WHERE id=:id";
        $stmt = $this->conn->prepare($deleteQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function update($id, $name, $cat_name, $description, $price, $available, $image = null)
    {
        // var_dump($image);
        if ($image) {
            $updateQuery = "UPDATE menu_items SET name=:name,category_id=:category_id, description=:description,
            price=:price, image=:image, available=:available WHERE id=:id ";
            $stmt = $this->conn->prepare($updateQuery);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':category_id', $cat_name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':available', $available);
        }else{
            $updateQuery = "UPDATE menu_items SET name=:name,category_id=:category_id, description=:description,
            price=:price, available=:available WHERE id=:id ";
            $stmt = $this->conn->prepare($updateQuery);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':category_id', $cat_name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            // $stmt->bindParam(':image', $image);
            $stmt->bindParam(':available', $available);
        }
        
        return $stmt->execute();
    }
    public function select()
    {
        $selectQuery = "SELECT * FROM categories c 
        join menu_items m on c.id=m.category_id ";
        $stmt = $this->conn->prepare($selectQuery);
        // $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();  // FIXED TYPO HERE
        $item = $stmt->fetchAll(PDO::FETCH_ASSOC);  // FIX FETCH METHOD
        if ($item) {
            return $item;
        } else {
            echo "error";
        }
    }
}
