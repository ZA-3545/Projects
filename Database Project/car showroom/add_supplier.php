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

    $sql = "INSERT INTO supplier (supplierid, suppliername, contactnumber, suppliedcar, suppliesbrandname, address)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiss", $_POST['supplierid'], $_POST['suppliername'], $_POST['contactnumber'], $_POST['suppliedcar'], $_POST['suppliesbrandname'], $_POST['address']);

    if ($stmt->execute()) {
        $message = "<p class='text-green-600 font-medium text-center'>✅ Supplier added successfully. <a href='view_supplier.php' class='text-blue-600 underline'>Back to List</a></p>";
    } else {
        $message = "<p class='text-red-600 font-medium text-center'>❌ Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Supplier</title>
    <script src="https://cdn.tailwindcss.com"></script>
     <style>
    body {
      background: url('https://t3.ftcdn.net/jpg/07/12/99/02/360_F_712990244_PouAWNfihLbOGWJC8zUs9xPBUY0Yb4c1.jpg') no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-6">🚚 Add New Supplier</h2>

    <?php echo $message; ?>

    <form method="post" class="space-y-4">
        <div>
            <label class="font-medium">Supplier ID:</label>
            <input type="text" name="supplierid" required class="w-full border p-2 rounded-md">
        </div>

        <div>
            <label class="font-medium">Supplier Name:</label>
            <input type="text" name="suppliername" required class="w-full border p-2 rounded-md">
        </div>

        <div>
            <label class="font-medium">Contact Number:</label>
            <input type="text" name="contactnumber" required class="w-full border p-2 rounded-md">
        </div>

        <div>
            <label class="font-medium">Supplied Cars:</label>
            <input type="number" name="suppliedcar" required class="w-full border p-2 rounded-md">
        </div>

        <div>
            <label class="font-medium">Brand Name:</label>
            <input type="text" name="suppliesbrandname" required class="w-full border p-2 rounded-md">
        </div>

        <div>
            <label class="font-medium">Address:</label>
            <input type="text" name="address" required class="w-full border p-2 rounded-md">
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="index.php" class="text-blue-600 hover:underline">🏠 Home</a>
            <input type="submit" name="submit" value="Add Supplier" class="bg-blue-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-700">
        </div>
    </form>
</div>

</body>
</html>
