<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $model = $_POST['model'];
    $color = $_POST['color'];
    $chasenumber = $_POST['chasenumber'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $typeofcar = $_POST['typeofcar'];
    $stockquantity = $_POST['stockquantity'];

    $sql = "INSERT INTO cars (name, model, color, chasenumber, brand, price, typeofcar, stockquantity)
            VALUES ('$name', '$model', '$color', '$chasenumber', '$brand', '$price', '$typeofcar', '$stockquantity')";

    if ($conn->query($sql)) {
        echo "<p class='text-green-700 text-center font-semibold mt-6'>✅ Car added successfully. <a class='text-blue-600 hover:underline' href='view_car.php'>Back to List</a></p>";
    } else {
        echo "<p class='text-red-600 text-center font-semibold mt-6'>❌ Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Car</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('https://guangcaiauto.com/wp-content/uploads/2024/05/Used-car-showroom-7.webp') no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>
<body class="min-h-screen bg-black bg-opacity-50 text-white">

  <div class="max-w-2xl mx-auto bg-white/90 text-gray-800 mt-16 p-8 rounded-xl shadow-lg">
    <h2 class="text-3xl font-bold text-center mb-6 text-blue-700">🚘 Add New Car</h2>

    <form method="post" class="space-y-5">
      <div>
        <label class="block font-semibold mb-1">Car Name</label>
        <input type="text" name="name" required class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div>
        <label class="block font-semibold mb-1">Model</label>
        <input type="text" name="model" required class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div>
        <label class="block font-semibold mb-1">Color</label>
        <input type="text" name="color" required class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div>
        <label class="block font-semibold mb-1">Chase Number</label>
        <input type="text" name="chasenumber" required class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div>
        <label class="block font-semibold mb-1">Brand</label>
        <input type="text" name="brand" required class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div>
        <label class="block font-semibold mb-1">Price (Rs.)</label>
        <input type="number" name="price" required class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div>
        <label class="block font-semibold mb-1">Type of Car</label>
        <input type="text" name="typeofcar" required class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div>
        <label class="block font-semibold mb-1">Stock Quantity</label>
        <input type="number" name="stockquantity" required class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div class="flex justify-between items-center">
        <a href="index.php" class="text-blue-700 hover:underline">🏠 Home</a>
        <input type="submit" name="submit" value="➕ Add Car" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold shadow">
      </div>
    </form>
  </div>
</body>
</html>
