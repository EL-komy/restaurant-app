<?php
class Order
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertOrder($user_id,$status,$total_price)
    {
        $insertQuery = "INSERT INTO orders (user_id,status,total_price) VALUES
         (:user_id,:status,:total_price)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':total_price', $total_price);
        return $stmt->execute();
    }
    public function insertItem($order_id,$item_id,$quantity,$price)
    {
        $insertQuery = "INSERT INTO order_details (order_id,item_id,quantity,price) VALUES
         (:order_id,:item_id,:quantity,:price)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->bindParam(':item_id', $item_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

    public function selectOneOrder($user_id) {
        $sql = "SELECT * FROM orders WHERE user_id = :user_id AND status = 'pending'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function totalSales() {
        $sql = "SELECT ROUND(SUM(total_price), 2) as total_price FROM orders WHERE status = 'Delivered'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(); 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    public function totalOrder() {
        $sql = "SELECT count(*) as orders FROM orders WHERE status = 'Delivered'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(); 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
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
    // public function selectone($id)
    // {
    //     $selectQuery = "SELECT * FROM categories c 
    //     join menu_items m on c.id=m.category_id WHERE m.id=:id";
    //     $stmt = $this->conn->prepare($selectQuery);
    //     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //     $stmt->execute();  // FIXED TYPO HERE
    //     $item = $stmt->fetch(PDO::FETCH_ASSOC);  // FIX FETCH METHOD
    //     if ($item) {
    //         return $item;
    //     } else {
    //         echo "error";
    //     }
    // }
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
