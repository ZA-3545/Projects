<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['bookingid'])) {
    $conn = new mysqli("localhost", "root", "03120453586", "cars");
    if ($conn->connect_error) die("Connection failed");

    $bookingid = $conn->real_escape_string($_POST['bookingid']);
    $status = (isset($_POST['undo']) && $_POST['undo'] == 1) ? 'Not Done' : 'Done';

    $sql = "UPDATE booking SET bookingstatus='$status' WHERE bookingid='$bookingid'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }

    $conn->close();
}
?>
