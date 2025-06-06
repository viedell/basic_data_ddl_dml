<?php include 'db.php'; ?>

<h2>📋 Full List of All Master Data</h2>

<!-- USERS -->
<h3>Users</h3>
<?php
$result = $conn->query("SELECT * FROM users");
if ($result && $result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Username</th><th>Email</th><th>Created</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['user_id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>{$row['created_at']}</td>
              </tr>";
    }
    echo "</table><br>";
} else {
    echo "No users found.<br><br>";
}
?>

<!-- CATEGORIES -->
<h3>Categories</h3>
<?php
$result = $conn->query("SELECT * FROM categories");
if ($result && $result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Description</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['category_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['description']}</td>
              </tr>";
    }
    echo "</table><br>";
} else {
    echo "No categories found.<br><br>";
}
?>

<!-- SUPPLIERS -->
<h3>Suppliers</h3>
<?php
$result = $conn->query("SELECT * FROM suppliers");
if ($result && $result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['supplier_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['contact_email']}</td>
                <td>{$row['phone']}</td>
              </tr>";
    }
    echo "</table><br>";
} else {
    echo "No suppliers found.<br><br>";
}
?>

<!-- PRODUCTS -->
<h3>Products</h3>
<?php
$result = $conn->query("
    SELECT p.product_id, p.name, p.price, p.stock,
           c.name AS category, s.name AS supplier
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.category_id
    LEFT JOIN suppliers s ON p.supplier_id = s.supplier_id
");
if ($result && $result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Category</th><th>Supplier</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['product_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['price']}</td>
                <td>{$row['stock']}</td>
                <td>{$row['category']}</td>
                <td>{$row['supplier']}</td>
              </tr>";
    }
    echo "</table><br>";
} else {
    echo "No products found.<br><br>";
}
?>

<!-- ORDERS -->
<h3>Orders</h3>
<?php
$result = $conn->query("
    SELECT o.order_id, o.quantity, o.order_date,
           p.name AS product, u.username AS user
    FROM orders o
    LEFT JOIN products p ON o.product_id = p.product_id
    LEFT JOIN users u ON o.user_id = u.user_id
");
if ($result && $result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Product</th><th>User</th><th>Qty</th><th>Date</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['order_id']}</td>
                <td>{$row['product']}</td>
                <td>{$row['user']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['order_date']}</td>
              </tr>";
    }
    echo "</table><br>";
} else {
    echo "No orders found.<br><br>";
}
?>

<br><a href="index.php"><button>Back to Homepage</button></a>
