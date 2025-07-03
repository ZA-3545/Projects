<?php
$conn = new mysqli("localhost", "root", "03120453586", "cars");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$message = "";

// Update logic
if (isset($_POST['update'])) {
    $name = $_POST['customername'];
    $contact = $_POST['contactnumber'];
    $email = $_POST['email'];
    $cnic = $_POST['cnic'];
    $gender = $_POST['gender'];
    $dob = $_POST['dateofbirth'];
    $address = $_POST['address'];

    $sql = "UPDATE customer SET 
            customername='$name', contactnumber='$contact', email='$email', 
            cnic='$cnic', gender='$gender', dateofbirth='$dob', address='$address' 
            WHERE customerid='$id'";

    if ($conn->query($sql) === TRUE) {
        $message = "<p class='text-green-600 text-center'>✅ Customer updated successfully. <a href='view_customer.php' class='text-blue-600 underline'>Back to List</a></p>";
    } else {
        $message = "<p class='text-red-600 text-center'>❌ Error: " . $conn->error . "</p>";
    }
}

$sql = "SELECT * FROM customer WHERE customerid='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Customer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white shadow-xl rounded-xl w-full max-w-2xl p-8">
    <h2 class="text-2xl font-bold mb-6 text-center">🧍 Edit Customer</h2>

    <?= $message ?>

    <form method="post" class="space-y-4">
        <div>
            <label class="block font-semibold">Name:</label>
            <input type="text" name="customername" value="<?= $row['customername'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Contact Number:</label>
            <input type="text" name="contactnumber" value="<?= $row['contactnumber'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Email:</label>
            <input type="email" name="email" value="<?= $row['email'] ?>" class="w-full border p-2 rounded-md">
        </div>

        <div>
            <label class="block font-semibold">CNIC:</label>
            <input type="text" name="cnic" value="<?= $row['cnic'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Gender:</label>
            <select name="gender" class="w-full border p-2 rounded-md">
                <option value="Male" <?= $row['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= $row['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold">Date of Birth:</label>
            <input type="text" name="dateofbirth" value="<?= $row['dateofbirth'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Address:</label>
            <input type="text" name="address" value="<?= $row['address'] ?>" class="w-full border p-2 rounded-md">
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="view_customer.php" class="text-blue-600 underline">🔙 View Customers</a>
            <input type="submit" name="update" value="Update Customer" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 font-semibold">
        </div>
    </form>
</div>

</body>
</html>
