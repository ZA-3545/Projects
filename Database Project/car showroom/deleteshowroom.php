<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) die("Connection failed.");

$location = $_GET['location'];
$conn->query("DELETE FROM showroom WHERE location='$location'");

header("Location: view_showroom.php");
$conn->close();
?>
