#database name

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


