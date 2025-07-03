<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$message = "";
if (isset($_POST['submit'])) {
    $conn = new mysqli("localhost", "root", "03120453586", "cars");
    if ($conn->connect_error) die("Connection failed");

    $sql = "INSERT INTO stock (stocknumber, quantityofstock, lastshipmentdate, availabiltyofstock)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisi", $_POST['stocknumber'], $_POST['quantityofstock'], $_POST['lastshipmentdate'], $_POST['availabiltyofstock']);

    if ($stmt->execute()) {
        $message = "<p class='text-green-600 font-medium text-center'>✅ Stock added successfully. <a href='view_stock.php' class='text-blue-600 underline'>Back to List</a></p>";
    } else {
        $message = "<p class='text-red-600 font-medium text-center'>❌ Error: " . $conn->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    body {
      background: url('https://www.goodcarbadcar.net/wp-content/uploads/2024/05/different-used-cars-for-sale-picjumbo-com-1024x683.jpg') no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-6">📦 Add Stock Record</h2>

    <?php echo $message; ?>

    <form method="post" class="space-y-4">
        <div>
            <label class="font-medium">Stock Number:</label>
            <input type="text" name="stocknumber" required class="w-full border p-2 rounded-md">
        </div>

        <div>
            <label class="font-medium">Quantity of Stock:</label>
            <input type="number" name="quantityofstock" required class="w-full border p-2 rounded-md">
        </div>

        <div>
            <label class="font-medium">Last Shipment Date:</label>
            <input type="text" name="lastshipmentdate" placeholder="e.g. 08-Sep" required class="w-full border p-2 rounded-md">
        </div>

        <div>
            <label class="font-medium">Available Stock:</label>
            <input type="number" name="availabiltyofstock" required class="w-full border p-2 rounded-md">
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="index.php" class="text-blue-600 hover:underline">🏠 Home</a>
            <input type="submit" name="submit" value="Add Stock" class="bg-blue-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-700">
        </div>
    </form>
</div>

</body>
</html>
