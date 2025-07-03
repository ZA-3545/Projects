<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) die("Connection failed.");

$location = $_GET['location'];
$message = "";

// Handle update
if (isset($_POST['update'])) {
    $capcity = $_POST['capcity'];
    $staffs = $_POST['numberofstaffs'];
    $cars = $_POST['numberofcar'];

    $sql = "UPDATE showroom SET 
            capcity='$capcity', 
            numberofstaffs='$staffs', 
            numberofcar='$cars' 
            WHERE location='$location'";

    if ($conn->query($sql)) {
        $message = "<p class='text-green-600 text-center'>✅ Updated successfully. <a href='view_showroom.php' class='text-blue-600 underline'>Back</a></p>";
    } else {
        $message = "<p class='text-red-600 text-center'>❌ Error: {$conn->error}</p>";
    }
}

$result = $conn->query("SELECT * FROM showroom WHERE location='$location'");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Showroom</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white shadow-md rounded-xl p-8 w-full max-w-lg">
    <h2 class="text-2xl font-bold mb-6 text-center">🏢 Edit Showroom at <?= htmlspecialchars($location) ?></h2>

    <?= $message ?>

    <form method="post" class="space-y-4">
        <div>
            <label class="block font-semibold">Capacity:</label>
            <input type="number" name="capcity" value="<?= $row['capcity'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Number of Staffs:</label>
            <input type="number" name="numberofstaffs" value="<?= $row['numberofstaffs'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Number of Cars:</label>
            <input type="number" name="numberofcar" value="<?= $row['numberofcar'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="view_showroom.php" class="text-blue-600 underline">🔙 View Showrooms</a>
            <input type="submit" name="update" value="Update Showroom" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 font-semibold">
        </div>
    </form>
</div>

</body>
</html>
