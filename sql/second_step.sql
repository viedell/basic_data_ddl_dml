INSERT INTO users (username, email, password) VALUES 
('admin1', 'admin1@example.com', 'password123');

INSERT INTO categories (name, description) VALUES 
('Electronics', 'Devices and gadgets'),
('Books', 'Various types of books');

INSERT INTO suppliers (name, contact_email, phone) VALUES 
('ABC Suppliers', 'abc@example.com', '123456789'),
('XYZ Traders', 'xyz@example.com', '987654321');

INSERT INTO products (name, price, stock, category_id, supplier_id) VALUES 
('Laptop', 800.00, 10, 1, 1),
('Smartphone', 500.00, 25, 1, 2),
('Novel', 15.00, 100, 2, 1);

INSERT INTO orders (product_id, quantity, order_date, user_id) VALUES 
(1, 2, '2025-06-05', 1),
(3, 5, '2025-06-06', 1);
