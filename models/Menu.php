<?php

class Menu
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Insert new menu item
    public function insert($name, $category_id, $description, $price, $image)
    {
        $insertQuery = "INSERT INTO menu_items (name, category_id, description, price, image) VALUES 
        (:name, :category_id, :description, :price, :image)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }

    public function insertOffer($id, $price, $expiry_date)
    {
        $insertQuery = "INSERT INTO offers (item_id, new_price, expiry_at) VALUES
         (:id, :price, :expiry_date)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':expiry_date', $expiry_date);
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

    // Select all menu items
    public function select()
    {
        $selectQuery = "SELECT * FROM categories c 
        JOIN menu_items m ON c.id = m.category_id";
        $stmt = $this->conn->prepare($selectQuery);
        $stmt->execute();
        $item = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $item;
    }

    // Select a single menu item
    public function selectone($id)
    {
        $selectQuery = "SELECT * FROM categories c 
        JOIN menu_items m ON c.id = m.category_id WHERE m.id = :id";
        $stmt = $this->conn->prepare($selectQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        return $item;
    }

    // Delete menu item
    public function delete($id)
    {
        $deleteQuery = "DELETE FROM menu_items WHERE id = :id";
        $stmt = $this->conn->prepare($deleteQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Update menu item
    public function update($id, $name, $cat_name, $description, $price, $available, $image = null)
    {
        if ($image) {
            $updateQuery = "UPDATE menu_items SET name = :name, category_id = :category_id, description = :description, 
            price = :price, image = :image, available = :available WHERE id = :id";
            $stmt = $this->conn->prepare($updateQuery);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':category_id', $cat_name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':available', $available);
        } else {
            $updateQuery = "UPDATE menu_items SET name = :name, category_id = :category_id, description = :description, 
            price = :price, available = :available WHERE id = :id";
            $stmt = $this->conn->prepare($updateQuery);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':category_id', $cat_name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':available', $available);
        }
        return $stmt->execute();
    }
}
?>
