<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) die("Connection failed");

$id = $_GET['id'];
$message = "";

if (isset($_POST['update'])) {
    $sql = "UPDATE booking SET 
        carchasenumber='{$_POST['carchasenumber']}',
        carcolor='{$_POST['carcolor']}',
        bookingdate='{$_POST['bookingdate']}',
        bookingstatus='{$_POST['bookingstatus']}'
        WHERE bookingid='$id'";

    if ($conn->query($sql)) {
        $message = "<p class='text-green-600 font-medium text-center'>✅ Updated successfully. <a href='view_booking.php' class='underline text-blue-600'>Back</a></p>";
    } else {
        $message = "<p class='text-red-600 font-medium text-center'>❌ Error: {$conn->error}</p>";
    }
}

$row = $conn->query("SELECT * FROM booking WHERE bookingid = '$id'")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white shadow-md rounded-xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-6">📝 Edit Booking (ID: <?= $id ?>)</h2>

    <?= $message ?>

    <form method="post" class="space-y-4">
        <div>
            <label class="font-medium">Car Chase #:</label>
            <input type="text" name="carchasenumber" value="<?= $row['carchasenumber'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="font-medium">Car Color:</label>
            <input type="text" name="carcolor" value="<?= $row['carcolor'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="font-medium">Booking Date:</label>
            <input type="text" name="bookingdate" value="<?= $row['bookingdate'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="font-medium">Booking Status:</label>
            <select name="bookingstatus" class="w-full border p-2 rounded-md" required>
                <option value="done" <?= $row['bookingstatus'] == 'done' ? 'selected' : '' ?>>done</option>
                <option value="not done" <?= $row['bookingstatus'] == 'not done' ? 'selected' : '' ?>>not done</option>
            </select>
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="index.php" class="text-blue-600 hover:underline">🏠 Home</a>
            <input type="submit" name="update" value="Update Booking" class="bg-blue-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-700">
        </div>
    </form>
</div>

</body>
</html>
