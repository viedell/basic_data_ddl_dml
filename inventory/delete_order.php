<?php include 'db.php'; ?>

<h2>Delete Order</h2>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM orders WHERE order_id = $id";
    if ($conn->query($sql)) {
        echo "Order deleted.<br><br>";
    } else {
        echo "Error: " . $conn->error . "<br><br>";
    }
}

$result = $conn->query("
    SELECT o.order_id, p.name AS product, u.username AS user, o.quantity, o.order_date
    FROM orders o
    LEFT JOIN products p ON o.product_id = p.product_id
    LEFT JOIN users u ON o.user_id = u.user_id
");

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>
            <tr><th>Product</th><th>User</th><th>Quantity</th><th>Date</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['product']}</td>
                <td>{$row['user']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['order_date']}</td>
                <td><a href='delete_order.php?id={$row['order_id']}' onclick='return confirm(\"Delete this order?\")'>🗑 Delete</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No orders found.";
}

echo '<br><br><a href="index.php">Back to Homepage</a>';
?>