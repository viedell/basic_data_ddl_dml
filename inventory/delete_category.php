<?php include 'db.php'; ?>

<h2>Delete Category (Selective)</h2>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $check = $conn->query("SELECT * FROM products WHERE category_id = $id");
    if ($check->num_rows > 0) {
        echo "⚠️ Cannot delete: Category has existing products.<br><br>";
    } else {
        $sql = "DELETE FROM categories WHERE category_id = $id";
        if ($conn->query($sql)) {
            echo "Category deleted.<br><br>";
        } else {
            echo "Error: " . $conn->error . "<br><br>";
        }
    }
}

$result = $conn->query("
    SELECT c.category_id, c.name, COUNT(p.product_id) AS product_count
    FROM categories c
    LEFT JOIN products p ON c.category_id = p.category_id
    GROUP BY c.category_id
");

if ($result && $result->num_rows > 0) {
    echo "<table border='1'>
            <tr><th>Name</th><th>Products</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['product_count']}</td>
                <td>";
        if ($row['product_count'] == 0) {
            echo "<a href='delete_category.php?id={$row['category_id']}' onclick='return confirm(\"Delete this category?\")'>🗑 Delete</a>";
        } else {
            echo "Cannot delete";
        }
        echo "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No categories found.";
}
?>

<br><a href="index.php"><button>Back to Homepage</button></a>