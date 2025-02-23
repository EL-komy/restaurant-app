-- CREATE database fryco;
-- use fryco;

CREATE TABLE `users`(
    id int PRIMARY KEY AUTO_INCREMENT,
    user_name varchar(255),
    email varchar(255) unique,
    passwordd varchar(255),
    rolee int,
    profile_picture text,
    phone int,
    addresss varchar(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);
CREATE TABLE `categories`(
    id int PRIMARY KEY AUTO_INCREMENT,
    ctegory_name varchar(255)
);

CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,
    description TEXT,
    price FLOAT NOT NULL,
    image TEXT,
    available ENUM('yes', 'no') NOT NULL DEFAULT 'yes'
);

CREATE TABLE item_options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    im  age TEXT,
    FOREIGN KEY (item_id) REFERENCES menu_items(id) ON DELETE CASCADE
);

CREATE TABLE offers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    new_price FLOAT NOT NULL,
    expiry_at TIMESTAMP ,
    FOREIGN KEY (item_id) REFERENCES menu_items(id) ON DELETE CASCADE
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    status ENUM('pending', 'preparing', 'Ready', 'Delivered') NOT NULL DEFAULT 'pending',
    total_price FLOAT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    menu_item_id INT NOT NULL,
    customizations TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE CASCADE
);

CREATE TABLE order_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL CHECK (quantity > 0),
    price DECIMAL(10,2) NOT NULL CHECK (price >= 0),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES menu_items(id) ON DELETE CASCADE
);

CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date TIMESTAMP NOT NULL,
    total_sales DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    type VARCHAR(50) NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE);


CREATE TABLE `tables`(
    id int PRIMARY KEY AUTO_INCREMENT ,
    chairs int,
    available boolean

);
CREATE TABLE `reservation`(
    id int PRIMARY KEY AUTO_INCREMENT,
    user_id int,
    table_id int ,
    reservation_date date,
    reservation_time time,
    guests int,
    table_status boolean,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
     FOREIGN KEY (table_id) REFERENCES tables(id) ON DELETE CASCADE,
     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE `suppliers` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    supplier_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `inventory` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    item_name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL CHECK (quantity >= 0),
    supplier_id INT,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id) ON DELETE SET NULL
);

CREATE TABLE `payments` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    payment_method TEXT NOT NULL,
    amount DECIMAL(10,2) NOT NULL CHECK (amount >= 0),
    status ENUM('pending', 'completed', 'failed') NOT NULL,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

CREATE TABLE `itemcontent`(
    id int PRIMARY KEY AUTO_INCREMENT ,
    item_id int,
    inventory_id int,
    FOREIGN KEY (item_id) REFERENCES menu_items(id) ON DELETE CASCADE,
    FOREIGN KEY (inventory_id) REFERENCES inventory(id) ON DELETE CASCADE
);
-- ----------------------INSERT-----------------------------
INSERT INTO `users` (user_name, email, passwordd, rolee, profile_picture, addresss) 
VALUES 
('John Doe', 'john@example.com', 'hashedpassword123', 1, 'john.png', '123 Main St'),
('Jane Smith', 'jane@example.com', 'securepass456', 2, 'jane.jpg', '456 Elm St'),
('Alice Brown', 'alice@example.com', 'mypassword789', 1, 'alice.png', '789 Pine St');

INSERT INTO `categories` (id, ctegory_name) 
VALUES 
(1, 'BURGER'),
(2, 'PIZZA'),
(3, 'CREPE');

INSERT INTO `tables` (id, chairs, available) 
VALUES 
(1, 4, TRUE),
(2, 2, FALSE),
(3, 6, TRUE);

INSERT INTO `reservation` (id, user_id, table_id, reservation_date, reservation_time, guests, table_status) 
VALUES 
(1, 1, 1, '2025-02-10', '18:00', 4, TRUE),
(2, 2, 2, '2025-02-12', '20:00', 2, FALSE),
(3, 3, 3, '2025-02-15', '19:30', 6, TRUE);

INSERT INTO `suppliers` (supplier_name, email, phone) VALUES
('ABC Supplies', 'abc@example.com', '555-1234'),
('XYZ Traders', 'xyz@example.com', '555-5678'),
('Fresh Foods', 'fresh@example.com', '555-8765');

INSERT INTO `inventory` (item_name, quantity, supplier_id) VALUES
('Tomato', 100, 1),  
('Cheese', 50, 2),   
('Olive Oil', 200, 3);  

INSERT INTO menu_items (name, category_id, description, price, image, available) VALUES
('Burger', 1, 'Delicious beef burger', 5.99, 'burger.jpg', 'yes'),
('Pizza', 2, 'Cheese pizza with toppings', 8.99, 'pizza.jpg', 'yes'),
('Pasta', 3, 'Creamy Alfredo pasta', 7.49, 'pasta.jpg', 'yes');

INSERT INTO `itemcontent` (id, item_id, inventory_id) 
VALUES 
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

INSERT INTO orders (user_id, status, total_price) VALUES
(1, 'pending', 14.98),
(2, 'preparing', 8.99),
(3, 'Delivered', 5.99);

INSERT INTO order_options (order_id, menu_item_id, customizations) VALUES
(1, 1, 'Extra cheese, No onions'),
(2, 2, 'Spicy level 3'),
(3, 3, 'Gluten-free crust');


INSERT INTO order_details (order_id, item_id, quantity, price) VALUES
(1, 1, 2, 9.99),
(2, 2, 1, 12.50),
(3, 3, 3, 15.75);


INSERT INTO reports (date, total_sales, created_at) VALUES
('2025-02-01', 5000.00, NOW()),
('2025-02-02', 7500.50, NOW()),
('2025-02-03', 6200.75, NOW());

INSERT INTO notifications (user_id, message, type, is_read, created_at) VALUES
(1, 'Your order has been shipped!', 'order', FALSE, NOW()),
(2, 'New promotion available!', 'promo', TRUE, NOW()),
(3, 'Password changed successfully.', 'security', FALSE, NOW());




INSERT INTO item_options (item_id, name, image) VALUES
(1, 'Extra Cheese', 'cheese.jpg'),
(2, 'Olives', 'olives.jpg'),
(3, 'Garlic Bread', 'garlic_bread.jpg');






INSERT INTO `payments` (order_id, payment_method, amount, status) VALUES
(1, 'Credit Card', 50.00, 'completed'),
(2, 'Cash', 30.00, 'pending'),
(3, 'Paypal', 75.00, 'completed');


-- TRRIGER for item content

DELIMITER //

CREATE TRIGGER update_menu_item_availability
AFTER UPDATE ON inventory
FOR EACH ROW
BEGIN
    DECLARE item_count INT;
    DECLARE out_of_stock INT;

    -- Check if the updated inventory item is associated with any menu item
    SELECT COUNT(*) INTO item_count
    FROM itemcontent
    WHERE inventory_id = NEW.id;

    -- If the inventory item is associated with a menu item
    IF item_count > 0 THEN
        -- Check if any of the required inventory items are out of stock
        SELECT COUNT(*) INTO out_of_stock
        FROM itemcontent ic
        JOIN inventory i ON ic.inventory_id = i.id
        WHERE ic.item_id IN (
            SELECT item_id
            FROM itemcontent
            WHERE inventory_id = NEW.id
        )
        AND i.quantity <= 0;

        -- If any required inventory item is out of stock, mark the menu item as unavailable
        IF out_of_stock > 0 THEN
            UPDATE menu_items
            SET available = 'no'
            WHERE id IN (
                SELECT item_id
                FROM itemcontent
                WHERE inventory_id = NEW.id
            );
        ELSE
            -- If all required inventory items are in stock, mark the menu item as available
            UPDATE menu_items
            SET available = 'yes'
            WHERE id IN (
                SELECT item_id
                FROM itemcontent
                WHERE inventory_id = NEW.id
            );
        END IF;
    END IF;
END //

DELIMITER ;
