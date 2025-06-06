<?php include 'db.php'; ?>

<h2>Add User</h2>
<form method="post">
    Username: <input type="text" name="username" required><br><br>
    Email: <input type="email" name="email"><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Add User</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Note: Insecure (plaintext password)

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql)) {
        echo "User added!";
    } else {
        echo "Error: " . $conn->error;
    }
}

echo '<br><br><a href="index.php"> Back to Homepage</a>';
?>