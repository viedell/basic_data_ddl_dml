<?php include 'db.php'; ?>

<h2>Product List</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th><th>Name</th><th>Price</th><th>Stock</th>
    </tr>

<?php
$result = $conn->query("SELECT * FROM products");
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['product_id']}</td>
            <td>{$row['name']}</td>
            <td>\${$row['price']}</td>
            <td>{$row['stock']}</td>
          </tr>";
}
?>
</table>