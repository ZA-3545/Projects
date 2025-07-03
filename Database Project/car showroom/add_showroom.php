<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$password = "03120453586";
$dbname = "cars";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = $_POST['location'];
    $capcity = $_POST['capcity'];
    $numberofstaffs = $_POST['numberofstaffs'];
    $numberofcar = $_POST['numberofcar'];

    $sql = "INSERT INTO showroom (location, capcity, numberofstaffs, numberofcar)
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("siii", $location, $capcity, $numberofstaffs, $numberofcar);

    if ($stmt->execute()) {
        $message = "<p class='text-green-600 font-semibold text-center mb-4'>✅ Showroom added successfully! <a href='view_showroom.php' class='text-blue-600 underline'>Back to List</a></p>";
    } else {
        $message = "<p class='text-red-600 font-semibold text-center mb-4'>❌ Error: " . $stmt->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Showroom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    body {
      background: url('https://voffice.com.sg/wp-content/uploads/2024/10/car-dealer-singapore.jpg') no-repeat center center fixed;
      background-size: cover;
    }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

<div class="w-full max-w-md bg-white shadow-md rounded-xl p-8">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">🏢 Add Showroom</h2>

    <?php echo $message; ?>

    <form method="POST" class="space-y-4">
        <div>
            <label class="font-semibold">Location:</label>
            <input type="text" name="location" required class="w-full p-2 border rounded-md">
        </div>

        <div>
            <label class="font-semibold">Capacity:</label>
            <input type="number" name="capcity" required class="w-full p-2 border rounded-md">
        </div>

        <div>
            <label class="font-semibold">Number of Staff:</label>
            <input type="number" name="numberofstaffs" required class="w-full p-2 border rounded-md">
        </div>

        <div>
            <label class="font-semibold">Number of Cars:</label>
            <input type="number" name="numberofcar" required class="w-full p-2 border rounded-md">
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="index.php" class="text-blue-600 hover:underline">🏠 Home</a>
            <input type="submit" value="Add Showroom" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold shadow">
        </div>
    </form>
</div>

</body>
</html>
