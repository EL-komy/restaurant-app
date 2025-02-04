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

