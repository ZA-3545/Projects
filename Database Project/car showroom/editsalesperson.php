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

// Update salesperson
if (isset($_POST['update'])) {
    $sql = "UPDATE salesperson SET 
        salespersonname='{$_POST['salespersonname']}',
        contactnumber='{$_POST['contactnumber']}',
        email='{$_POST['email']}',
        salary='{$_POST['salary']}',
        position='{$_POST['position']}',
        cnic='{$_POST['cnic']}'
        WHERE salespersonid='$id'";

    if ($conn->query($sql)) {
        $message = "<p class='text-green-600 text-center'>✅ Updated successfully. <a href='view_salesperson.php' class='text-blue-600 underline'>Back to List</a></p>";
    } else {
        $message = "<p class='text-red-600 text-center'>❌ Error: {$conn->error}</p>";
    }
}

$result = $conn->query("SELECT * FROM salesperson WHERE salespersonid = '$id'");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Salesperson</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-2xl">
    <h2 class="text-2xl font-bold text-center mb-6">🧑‍💼 Edit Salesperson ID: <?= htmlspecialchars($id) ?></h2>

    <?= $message ?>

    <form method="post" class="space-y-4">
        <div>
            <label class="block font-semibold">Name:</label>
            <input type="text" name="salespersonname" value="<?= $row['salespersonname'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Contact Number:</label>
            <input type="text" name="contactnumber" value="<?= $row['contactnumber'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Email:</label>
            <input type="text" name="email" value="<?= $row['email'] ?>" class="w-full border p-2 rounded-md">
        </div>

        <div>
            <label class="block font-semibold">Salary:</label>
            <input type="number" name="salary" value="<?= $row['salary'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Position:</label>
            <input type="text" name="position" value="<?= $row['position'] ?>" class="w-full border p-2 rounded-md">
        </div>

        <div>
            <label class="block font-semibold">CNIC:</label>
            <input type="text" name="cnic" value="<?= $row['cnic'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div class="flex justify-between pt-4">
            <a href="view_salesperson.php" class="text-blue-600 underline">🔙 View Salespersons</a>
            <input type="submit" name="update" value="Update Salesperson" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 font-semibold">
        </div>
    </form>
</div>

</body>
</html>
