
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Customers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php">🏠 Home</a> |
    <a href="logout.php" style="color:red; font-weight:bold;">🚪 Logout</a>
    <br><br>

    <h2>All Customers</h2>
    <a href="add_customer.php">➕ Add New Customer</a><br><br>

<?php
$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$result = $conn->query("SELECT * FROM customer");

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>
            <tr>
                <th>Name</th><th>ID</th><th>Contact</th><th>Email</th>
                <th>CNIC</th><th>Gender</th><th>DOB</th><th>Address</th><th>Actions</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['customername']}</td>
                <td>{$row['customerid']}</td>
                <td>{$row['contactnumber']}</td>
                <td>{$row['email']}</td>
                <td>{$row['cnic']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['dateofbirth']}</td>
                <td>{$row['address']}</td>
                <td>
                    <a href='edit_customer.php?id={$row['customerid']}'>✏️ Edit</a> |
                    <a href='delete_customer.php?id={$row['customerid']}' onclick=\"return confirm('Delete this customer?')\">🗑 Delete</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No customers found.</p>";
}
$conn->close();
?>
</body>
</html>

