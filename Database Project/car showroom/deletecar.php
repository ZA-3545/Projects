<?php
$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Make sure chasenumber is provided
$chasenumber = $_GET['chasenumber'] ?? die("No chasenumber provided.");

// Delete the car using chasenumber (assuming it is the unique identifier)
$sql = "DELETE FROM cars WHERE chasenumber = '$chasenumber'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Car deleted successfully!'); window.location.href='view_car.php';</script>";
} else {
    echo "Error deleting car: " . $conn->error;
}

$conn->close();
?>
