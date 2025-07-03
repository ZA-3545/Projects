<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$chasenumber = $_GET['chasenumber'];
$message = "";

// Handle form update
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $model = $_POST['model'];
    $color = $_POST['color'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $typeofcar = $_POST['typeofcar'];
    $stock = $_POST['stockquantity'];

    $sql = "UPDATE cars SET 
                name='$name', model='$model', color='$color',
                brand='$brand', price='$price', 
                typeofcar='$typeofcar', stockquantity='$stock'
            WHERE chasenumber='$chasenumber'";

    if ($conn->query($sql) === TRUE) {
        $message = "<p class='text-green-600 text-center'>✅ Car updated successfully. <a href='view_car.php' class='underline text-blue-600'>Back to List</a></p>";
    } else {
        $message = "<p class='text-red-600 text-center'>❌ Error: " . $conn->error . "</p>";
    }
}

$result = $conn->query("SELECT * FROM cars WHERE chasenumber='$chasenumber'");
if (!$result || $result->num_rows === 0) {
    die("<p class='text-red-600 text-center'>❌ Car not found.</p>");
}
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Car</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white shadow-xl rounded-xl w-full max-w-xl p-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">🚗 Edit Car (Chase #: <?= htmlspecialchars($chasenumber) ?>)</h2>
        <a href="index.php" class="text-blue-600 hover:underline">🏠 Home</a>
    </div>

    <?= $message ?>

    <form method="post" class="space-y-4">
        <div>
            <label class="font-medium">Name:</label>
            <input type="text" name="name" value="<?= $row['name'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="font-medium">Model:</label>
            <input type="text" name="model" value="<?= $row['model'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="font-medium">Color:</label>
            <input type="text" name="color" value="<?= $row['color'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="font-medium">Brand:</label>
            <input type="text" name="brand" value="<?= $row['brand'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="font-medium">Price:</label>
            <input type="number" name="price" value="<?= $row['price'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="font-medium">Type of Car:</label>
            <input type="text" name="typeofcar" value="<?= $row['typeofcar'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="font-medium">Stock Quantity:</label>
            <input type="number" name="stockquantity" value="<?= $row['stockquantity'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div class="flex justify-between pt-4">
            <a href="view_car.php" class="text-blue-600 hover:underline">🔙 View Cars</a>
            <input type="submit" name="update" value="Update Car" class="bg-blue-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-700">
        </div>
    </form>
</div>

</body>
</html>
