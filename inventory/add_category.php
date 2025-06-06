<?php include 'db.php'; ?>

<h2>Add Category</h2>
<form method="post">
    Name: <input type="text" name="name" required><br><br>
    Description: <textarea name="description"></textarea><br><br>
    <button type="submit">Add Category</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $desc = $_POST['description'];

    $sql = "INSERT INTO categories (name, description) VALUES ('$name', '$desc')";
    if ($conn->query($sql)) {
        echo "Category added!";
    } else {
        echo "Error: " . $conn->error;
    }
}

echo '<br><br><a href="index.php">Back to Homepage</a>';
?>