<?php include 'db.php'; ?>

<h2>Delete Product (Selective)</h2>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $check = $conn->query("SELECT * FROM orders WHERE product_id = $id");
    if ($check->num_rows > 0) {
        echo "Cannot delete: Product is used in existing orders.<br><br>";
    } else {
        $sql = "DELETE FROM products WHERE product_id = $id";
        if ($conn->query($sql)) {
            echo "Product deleted.<br><br>";
        } else {
            echo "Error: " . $conn->error . "<br><br>";
        }
    }
}

$result = $conn->query("
    SELECT p.product_id, p.name, c.name AS category, s.name AS supplier,
    (SELECT COUNT(*) FROM orders o WHERE o.product_id = p.product_id) AS order_count
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.category_id
    LEFT JOIN suppliers s ON p.supplier_id = s.supplier_id
");

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>
            <tr><th>Name</th><th>Category</th><th>Supplier</th><th>Orders</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['category']}</td>
                <td>{$row['supplier']}</td>
                <td>{$row['order_count']}</td>
                <td>";
        if ($row['order_count'] == 0) {
            echo "<a href='delete_product.php?id={$row['product_id']}' onclick='return confirm(\"Delete this product?\")'>🗑 Delete</a>";
        } else {
            echo "Cannot delete";
        }
        echo "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No products found.";
}

echo '<br><br><a href="index.php">Back to Homepage</a>';
?>