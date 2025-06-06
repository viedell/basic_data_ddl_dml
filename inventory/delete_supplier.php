<?php include 'db.php'; ?>

<h2>Delete Supplier (Selective)</h2>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $check = $conn->query("SELECT * FROM products WHERE supplier_id = $id");
    if ($check->num_rows > 0) {
        echo "⚠️ Cannot delete: Supplier has existing products.<br><br>";
    } else {
        $sql = "DELETE FROM suppliers WHERE supplier_id = $id";
        if ($conn->query($sql)) {
            echo "Supplier deleted.<br><br>";
        } else {
            echo "Error: " . $conn->error . "<br><br>";
        }
    }
}

$result = $conn->query("
    SELECT s.supplier_id, s.name, s.contact_email, COUNT(p.product_id) AS product_count
    FROM suppliers s
    LEFT JOIN products p ON s.supplier_id = p.supplier_id
    GROUP BY s.supplier_id
");

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>
            <tr><th>Name</th><th>Email</th><th>Products</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['contact_email']}</td>
                <td>{$row['product_count']}</td>
                <td>";
        if ($row['product_count'] == 0) {
            echo "<a href='delete_supplier.php?id={$row['supplier_id']}' onclick='return confirm(\"Delete this supplier?\")'>🗑 Delete</a>";
        } else {
            echo "Cannot delete";
        }
        echo "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No suppliers found.";
}

echo '<br><br><a href="index.php">Back to Homepage</a>';
?>