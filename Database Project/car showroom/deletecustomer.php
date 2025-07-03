<?php
$conn = new mysqli("localhost", "root", "03120453586", "cars");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "DELETE FROM customer WHERE customerid='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: view_customer.php");
} else {
    echo "Error deleting customer: " . $conn->error;
}

$conn->close();
?>
