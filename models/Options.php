<?php
class Options {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insert($item_id, $name, $image) {
        $insertQuery = "INSERT INTO item_options (item_id, name, image) VALUES (:item, :name, :image)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bindParam(':item', $item_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }

    public function selectall($id) {
        $selectQuery = "SELECT * FROM item_options where item_id = :item_id";
        $stmt = $this->conn->prepare($selectQuery);
        $stmt->bindParam(':item_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function select()
{
    $selectQuery = "
        SELECT 
            m.id AS menu_item_id,
            m.name AS menu_item_name,
            m.category_id AS menu_item_category_id,
            m.description AS menu_item_description,
            m.price AS menu_item_price,
            m.image AS menu_item_image,
            m.available AS menu_item_available,
            c.id AS option_id,
            c.name AS option_name,
            c.image AS option_image
        FROM 
            item_options c
        JOIN 
            menu_items m ON m.id = c.item_id
    ";

    $stmt = $this->conn->prepare($selectQuery);
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($items) {
        return $items;
    } else {
        echo "No data found.";
        return []; // Return an empty array instead of echoing "error"
    }
}
public function delete($id)
{
    $deleteQuery = "DELETE FROM item_options WHERE id=:id";
    $stmt = $this->conn->prepare($deleteQuery);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}
public function selectone($id)
{
    // Query to select a single item_option joined with its associated menu_item
    $selectQuery = "
        SELECT 
            o.id AS option_id,
            o.item_id AS menu_item_id,
            o.name AS option_name,
            o.image AS option_image,
            m.name AS menu_item_name,
            m.category_id AS menu_item_category_id,
            m.description AS menu_item_description,
            m.price AS menu_item_price,
            m.image AS menu_item_image,
            m.available AS menu_item_available
        FROM 
            item_options o
        JOIN 
            menu_items m ON m.id = o.item_id
        WHERE 
            o.id = :id
    ";

    // Prepare and execute the query
    $stmt = $this->conn->prepare($selectQuery);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the result as an associative array
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the item was found
    if ($item) {
        return $item;
    } else {
        echo "error";
        return null; // Return null if no item is found
    }
}
    public function update($id, $item_id, $name, $image = null)
{
    if ($image) {
        // Update query including the image
        $updateQuery = "
            UPDATE item_options 
            SET 
                item_id = :item_id, 
                name = :name, 
                image = :image 
            WHERE 
                id = :id
        ";
        $stmt = $this->conn->prepare($updateQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
    } else {
        // Update query excluding the image
        $updateQuery = "
            UPDATE item_options 
            SET 
                item_id = :item_id, 
                name = :name 
            WHERE 
                id = :id
        ";
        $stmt = $this->conn->prepare($updateQuery);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
    }

    // Execute the query and return the result
    return $stmt->execute();
}
}
?>