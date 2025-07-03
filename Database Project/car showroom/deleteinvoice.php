<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) die("Connection failed");

$id = $_GET['id'];
$conn->query("DELETE FROM invoice WHERE invoiceid='$id'");
header("Location: view_invoice.php");
$conn->close();
?>
