<?php include 'db.php'; ?>

<h2>Add Product</h2>
<form method="post">
    Name: <input type="text" name="name" required><br><br>
    Price: <input type="number" step="0.01" name="price" required><br><br>
    Stock: <input type="number" name="stock" required><br><br>

    Category:
    <select name="category_id" required>
        <option value="">-- Select --</option>
        <?php
        $res = $conn->query("SELECT * FROM categories");
        while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['category_id']}'>{$row['name']}</option>";
        }
        ?>
    </select><br><br>

    Supplier:
    <select name="supplier_id" required>
        <option value="">-- Select --</option>
        <?php
        $res = $conn->query("SELECT * FROM suppliers");
        while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['supplier_id']}'>{$row['name']}</option>";
        }
        ?>
    </select><br><br>

    <button type="submit">Add Product</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $cat = $_POST['category_id'];
    $sup = $_POST['supplier_id'];

    $sql = "INSERT INTO products (name, price, stock, category_id, supplier_id)
            VALUES ('$name', '$price', '$stock', '$cat', '$sup')";

    if ($conn->query($sql)) {
        echo "Product added!";
    } else {
        echo "Error: " . $conn->error;
    }
}

echo '<br><br><a href="index.php">Back to Homepage</a>';
?>
