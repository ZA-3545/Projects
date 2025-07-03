<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) die("Connection failed");

$id = $_GET['id'];

$sql = "DELETE FROM salesperson WHERE salespersonid = '$id'";
if ($conn->query($sql)) {
    header("Location: view_salesperson.php");
} else {
    echo "❌ Error deleting record: " . $conn->error;
}
$conn->close();
?>
