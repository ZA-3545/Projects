<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['invoiceid'])) {
    $conn = new mysqli("localhost", "root", "03120453586", "cars");
    if ($conn->connect_error) die("Connection failed");

    $invoiceid = $conn->real_escape_string($_POST['invoiceid']);
    $status = (isset($_POST['undo']) && $_POST['undo'] == 1) ? 'Not Done' : 'Done';

    $sql = "UPDATE invoice SET paymentstatus='$status' WHERE invoiceid='$invoiceid'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }

    $conn->close();
}
?>
