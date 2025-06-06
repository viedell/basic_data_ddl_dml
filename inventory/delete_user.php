<?php include 'db.php'; ?>

<h2>Delete User (Selective)</h2>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $check = $conn->query("SELECT * FROM orders WHERE user_id = $id");
    if ($check->num_rows > 0) {
        echo "Cannot delete: User has existing orders.<br><br>";
    } else {
        $sql = "DELETE FROM users WHERE user_id = $id";
        if ($conn->query($sql)) {
            echo "User deleted.<br><br>";
        } else {
            echo "Error: " . $conn->error . "<br><br>";
        }
    }
}

$result = $conn->query("
    SELECT u.user_id, u.username, u.email, COUNT(o.order_id) AS order_count
    FROM users u
    LEFT JOIN orders o ON u.user_id = o.user_id
    GROUP BY u.user_id
");

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>
            <tr><th>Username</th><th>Email</th><th>Orders</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>{$row['order_count']}</td>
                <td>";
        if ($row['order_count'] == 0) {
            echo "<a href='delete_user.php?id={$row['user_id']}' onclick='return confirm(\"Delete this user?\")'>🗑 Delete</a>";
        } else {
            echo "❌ Cannot delete";
        }
        echo "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No users found.";
}

echo '<br><br><a href="index.php">Back to Homepage</a>';
?>