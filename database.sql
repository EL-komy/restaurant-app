#database name
CREATE TABLE `users`(
    id int PRIMARY KEY AUTO_INCREMENT,
    user_name varchar(255),
    email varchar(255) unique,
    passwordd varchar(255),
    rolee int,
    profile_picture text,
    addresss varchar(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);
CREATE TABLE `categories`(
    id int PRIMARY KEY AUTO_INCREMENT,
    ctegory_name varchar(255)
);
CREATE TABLE `tables`(
    id int PRIMARY KEY AUTO_INCREMENT ,
    chairs int,
    available boolean

);
CREATE TABLE `reservation`(
    id int PRIMARY KEY AUTO_INCREMENT,
    user_id int,
    table_id int ,
    reservation_date text,
    reservation_time text,
    guests int,
    table_status boolean,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
     FOREIGN KEY (table_id) REFERENCES tables(id) ON DELETE CASCADE,
     FOREIGN KEY (useer_id) REFERENCES users(id) ON DELETE CASCADE
);
CREATE TABLE `itemcontent`(
    id int PRIMARY KEY AUTO_INCREMENT ,
    item_id int,
    inventory_id int,
    FOREIGN KEY (item_id) REFERENCES menu_items(id) ON DELETE CASCADE,
    FOREIGN KEY (inventory_id) REFERENCES inventory(id) ON DELETE CASCADE
);

CREATE TABLE `suppliers` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    namee VARCHAR(255) NOT NULL,
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

-- ----------------------INSERT-----------------------------
-- Insert data into users table
INSERT INTO `users` (user_name, email, passwordd, rolee, profile_picture, addresss) 
VALUES 
('John Doe', 'john@example.com', 'hashedpassword123', 1, 'john.png', '123 Main St'),
('Jane Smith', 'jane@example.com', 'securepass456', 2, 'jane.jpg', '456 Elm St'),
('Alice Brown', 'alice@example.com', 'mypassword789', 1, 'alice.png', '789 Pine St');

-- Insert data into categories table
INSERT INTO `categories` (id, ctegory_name) 
VALUES 
(1, 'BURGER'),
(2, 'PIZZA'),
(3, 'CREPE');

-- Insert data into tables table
INSERT INTO `tables` (id, chairs, available) 
VALUES 
(1, 4, TRUE),
(2, 2, FALSE),
(3, 6, TRUE);

-- Insert data into reservation table
INSERT INTO `reservation` (id, user_id, table_id, reservation_date, reservation_time, guests, table_status) 
VALUES 
(1, 1, 1, '2025-02-10', '18:00', 4, TRUE),
(2, 2, 2, '2025-02-12', '20:00', 2, FALSE),
(3, 3, 3, '2025-02-15', '19:30', 6, TRUE);

-- Insert data into itemcontent table
INSERT INTO `itemcontent` (id, item_id, inventory_id) 
VALUES 
(1, 101, 201),
(2, 102, 202),
(3, 103, 203);


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
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE


#############INSERT###################################################



INSERT INTO order_options (order_id, menu_item_id, customizations) VALUES
(1, 101, 'Extra cheese, No onions'),
(2, 102, 'Spicy level 3'),
(3, 103, 'Gluten-free crust');


INSERT INTO order_details (order_id, item_id, quantity, price) VALUES
(1, 101, 2, 9.99),
(2, 102, 1, 12.50),
(3, 103, 3, 15.75);


INSERT INTO reports (date, total_sales, created_at) VALUES
('2025-02-01', 5000.00, NOW()),
('2025-02-02', 7500.50, NOW()),
('2025-02-03', 6200.75, NOW());

INSERT INTO notifications (user_id, message, type, is_read, created_at) VALUES
(1, 'Your order has been shipped!', 'order', FALSE, NOW()),
(2, 'New promotion available!', 'promo', TRUE, NOW()),
(3, 'Password changed successfully.', 'security', FALSE, NOW());


INSERT INTO `suppliers` (name, email, phone) VALUES
('ABC Supplies', 'abc@example.com', '555-1234'),
('XYZ Traders', 'xyz@example.com', '555-5678'),
('Fresh Foods', 'fresh@example.com', '555-8765');

INSERT INTO `inventory` (item_name, quantity, supplier_id) VALUES
('Tomato', 100, 1),  
('Cheese', 50, 2),   
('Olive Oil', 200, 3);  


INSERT INTO `payments` (order_id, payment_method, amount, status) VALUES
(1, 'Credit Card', 50.00, 'completed'),
(2, 'Cash', 30.00, 'pending'),
(3, 'Paypal', 75.00, 'completed');
