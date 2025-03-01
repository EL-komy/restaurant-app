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

    // Insert new menu item
    public function insert($name, $category_id, $description, $price, $image) {
        $item = $this->item->insert($name, $category_id, $description, $price, $image);
        if (!$item) {
            http_response_code(400); // Bad Request
            echo json_encode(["message" => "Error inserting item"]);
        } else {
            http_response_code(201); // Created
            echo json_encode(["message" => "Item successfully added"]);
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
    

    public function selectcat() {
        // تعديل الاستعلام لعرض الأقسام مع العناصر
        $selectQuery = "SELECT c.ctegory_name as category_name, m.id as item_id, m.name  as item_name, m.description, m.price, m.image ,m.available as available
                        FROM categories c
                        JOIN menu_items m ON c.id = m.category_id";
        $stmt = $this->db->prepare($selectQuery); // تأكد من أنك تستخدم $this->db هنا وليس $this->conn
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // تنظيم العناصر حسب الأقسام
        $menu = [];
        foreach ($items as $item) {
            $menu[$item['category_name']][] = $item;
        }
    }
    public function select(){
        $item=$this->item->select();
        // var_export($item);
        return $item;
    }

    public function selectItems(){
        $item=$this->item->selectItems();
        // var_export($item);
        return $item;
    }

      
    // Select a single menu item
    public function selectone($id) {
        $item = $this->item->selectone($id);
        if ($item) {
            echo json_encode($item); // Return item as JSON
        } else {
            echo json_encode(["message" => "Item not found"]);
        }
    }

    // Delete a menu item
    public function delete($id) {
        $item = $this->item->delete($id);
        if ($item) {
            http_response_code(200); // OK
            echo json_encode(["message" => "Item deleted successfully"]);
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(["message" => "Error deleting item"]);
        }
    }
    
    public function selectcategory() {
        // استعلام لاستخراج كل الفئات مع العناصر
        $selectQuery = "SELECT c.ctegory_name as category_name, c.id as category_id, m.id as item_id, m.name as item_name, m.available as available , m.description, m.price, m.image
                        FROM categories c
                        LEFT JOIN menu_items m ON c.id = m.category_id"; // استخدام LEFT JOIN لعرض الفئات الفارغة
        $stmt = $this->db->prepare($selectQuery);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // تنظيم العناصر حسب الفئات
        $menu = [];
        foreach ($items as $item) {
            $menu[$item['category_name']][] = $item;
        }
    
        return $menu;
    }
    
        //OFFER

    public function selectOffers() {
        // Get only items that have an offer
        $selectQuery = "SELECT o.id, o.item_id, o.new_price, o.expiry_at, m.name AS item_name, m.description, m.price, m.image
                        FROM offers o
                        JOIN menu_items m ON o.item_id = m.id";
        $stmt = $this->db->prepare($selectQuery);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
        
    

    // Update a menu item
    public function update($id, $name, $cat_name, $description, $price, $available, $image) {
        if (empty($name) || empty($cat_name) || empty($description) || empty($price)) {
            http_response_code(400); // Bad Request
            echo json_encode(["message" => "All fields must be filled"]);
            return;
        }

        $item = $this->item->update($id, $name, $cat_name, $description, $price, $available, $image);
        if (!$item) {
            http_response_code(400); // Bad Request
            echo json_encode(["message" => "Error updating item"]);
        } else {
            http_response_code(200); // OK
            echo json_encode(["message" => "Item updated successfully"]);
        }
    }
}
?>
