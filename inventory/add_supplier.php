<?php include 'db.php'; ?>

<h2>Add Supplier</h2>
<form method="post">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="contact_email"><br><br>
    Phone: <input type="text" name="phone"><br><br>
    <button type="submit">Add Supplier</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['contact_email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO suppliers (name, contact_email, phone) VALUES ('$name', '$email', '$phone')";
    if ($conn->query($sql)) {
        echo "Supplier added!";
    } else {
        echo "Error: " . $conn->error;
    }
}

echo '<br><br><a href="index.php">Back to Homepage</a>';
?>