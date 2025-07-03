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
    $sql = "UPDATE supplier SET 
        suppliername='{$_POST['suppliername']}',
        contactnumber='{$_POST['contactnumber']}',
        suppliedcar='{$_POST['suppliedcar']}',
        suppliesbrandname='{$_POST['suppliesbrandname']}',
        address='{$_POST['address']}'
        WHERE supplierid='$id'";

    if ($conn->query($sql)) {
        $message = "<p class='text-green-600 text-center'>✅ Updated. <a href='view_supplier.php' class='text-blue-600 underline'>Back</a></p>";
    } else {
        $message = "<p class='text-red-600 text-center'>❌ Error: {$conn->error}</p>";
    }
}

$row = $conn->query("SELECT * FROM supplier WHERE supplierid = '$id'")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Supplier</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white shadow-md rounded-xl p-8 w-full max-w-lg">
    <h2 class="text-2xl font-bold mb-6 text-center">🚚 Edit Supplier #<?= htmlspecialchars($id) ?></h2>

    <?= $message ?>

    <form method="post" class="space-y-4">
        <div>
            <label class="block font-semibold">Name:</label>
            <input type="text" name="suppliername" value="<?= $row['suppliername'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Contact Number:</label>
            <input type="text" name="contactnumber" value="<?= $row['contactnumber'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Supplied Cars:</label>
            <input type="number" name="suppliedcar" value="<?= $row['suppliedcar'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Brand Name:</label>
            <input type="text" name="suppliesbrandname" value="<?= $row['suppliesbrandname'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Address:</label>
            <input type="text" name="address" value="<?= $row['address'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="view_supplier.php" class="text-blue-600 underline">🔙 View Suppliers</a>
            <input type="submit" name="update" value="Update Supplier" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 font-semibold">
        </div>
    </form>
</div>

</body>
</html>
 