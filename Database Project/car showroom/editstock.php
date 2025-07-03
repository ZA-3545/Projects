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
    $sql = "UPDATE stock SET 
        quantityofstock='{$_POST['quantityofstock']}',
        lastshipmentdate='{$_POST['lastshipmentdate']}',
        availabiltyofstock='{$_POST['availabiltyofstock']}'
        WHERE stocknumber='$id'";

    if ($conn->query($sql)) {
        $message = "<p class='text-green-600 text-center'>✅ Updated. <a href='view_stock.php' class='text-blue-600 underline'>Back</a></p>";
    } else {
        $message = "<p class='text-red-600 text-center'>❌ Error: {$conn->error}</p>";
    }
}

$row = $conn->query("SELECT * FROM stock WHERE stocknumber = '$id'")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white shadow-md rounded-xl p-8 w-full max-w-lg">
    <h2 class="text-2xl font-bold mb-6 text-center">📦 Edit Stock #<?= htmlspecialchars($id) ?></h2>

    <?= $message ?>

    <form method="post" class="space-y-4">
        <div>
            <label class="block font-semibold">Quantity of Stock:</label>
            <input type="number" name="quantityofstock" value="<?= $row['quantityofstock'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Last Shipment Date:</label>
            <input type="text" name="lastshipmentdate" value="<?= $row['lastshipmentdate'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Available Stock:</label>
            <input type="number" name="availabiltyofstock" value="<?= $row['availabiltyofstock'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="view_stock.php" class="text-blue-600 underline">🔙 View Stock</a>
            <input type="submit" name="update" value="Update Stock" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 font-semibold">
        </div>
    </form>
</div>

</body>
</html>
