<?php include 'db.php'; ?>

<h2>Add Order</h2>
<form method="post">
    Product:
    <select name="product_id" required>
        <option value="">-- Select --</option>
        <?php
        $res = $conn->query("SELECT * FROM products");
        while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['product_id']}'>{$row['name']}</option>";
        }
        ?>
    </select><br><br>

    Quantity: <input type="number" name="quantity" required><br><br>

    Order Date: <input type="date" name="order_date" required><br><br>

    User:
    <select name="user_id" required>
        <option value="">-- Select --</option>
        <?php
        $res = $conn->query("SELECT * FROM users");
        while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['user_id']}'>{$row['username']}</option>";
        }
        ?>
    </select><br><br>

    <button type="submit">Add Order</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product = $_POST['product_id'];
    $qty = $_POST['quantity'];
    $date = $_POST['order_date'];
    $user = $_POST['user_id'];

    $sql = "INSERT INTO orders (product_id, quantity, order_date, user_id)
            VALUES ('$product', '$qty', '$date', '$user')";

    if ($conn->query($sql)) {
        echo "Order added!";
    } else {
        echo "Error: " . $conn->error;
    }
}

echo '<br><br><a href="index.php">Back to Homepage</a>';
?>
