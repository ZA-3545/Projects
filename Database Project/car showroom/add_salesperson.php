<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$message = "";
if (isset($_POST['submit'])) {
    $conn = new mysqli("localhost", "root", "03120453586", "cars");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['salespersonname'];
    $id = $_POST['salespersonid'];
    $contact = $_POST['contactnumber'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];
    $position = $_POST['position'];
    $cnic = $_POST['cnic'];

    $stmt = $conn->prepare("INSERT INTO salesperson (salespersonid, salespersonname, contactnumber, email, salary, position, cnic) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $id, $name, $contact, $email, $salary, $position, $cnic);

    if ($stmt->execute()) {
        $message = "✅ Salesperson added successfully! <a href='view_salesperson.php' class='text-blue-600 underline'>Back to List</a>";
    } else {
        $message = "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Salesperson</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: url('https://c8.alamy.com/comp/2A7BYA2/client-shaking-hands-with-a-salesman-having-deal-in-the-showroom-with-sports-motorcycles-close-up-2A7BYA2.jpg') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-black bg-opacity-70">

    <div class="bg-white/90 max-w-xl w-full p-8 rounded-xl shadow-xl text-gray-800">
        <h2 class="text-3xl font-bold text-center text-green-700 mb-6">👤 Add New Salesperson</h2>

        <?php if ($message): ?>
            <p class="text-green-700 font-semibold mb-4"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="post" class="space-y-4">
            <div>
                <label class="font-semibold">Name:</label>
                <input type="text" name="salespersonname" required class="w-full p-2 border rounded-md">
            </div>

            <div>
                <label class="font-semibold">ID:</label>
                <input type="text" name="salespersonid" required class="w-full p-2 border rounded-md">
            </div>

            <div>
                <label class="font-semibold">Contact Number:</label>
                <input type="text" name="contactnumber" required class="w-full p-2 border rounded-md">
            </div>

            <div>
                <label class="font-semibold">Email:</label>
                <input type="email" name="email" class="w-full p-2 border rounded-md">
            </div>

            <div>
                <label class="font-semibold">Salary:</label>
                <input type="number" name="salary" required class="w-full p-2 border rounded-md">
            </div>

            <div>
                <label class="font-semibold">Position:</label>
                <input type="text" name="position" class="w-full p-2 border rounded-md">
            </div>

            <div>
                <label class="font-semibold">CNIC:</label>
                <input type="text" name="cnic" required class="w-full p-2 border rounded-md">
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="index.php" class="text-blue-600 hover:underline">🏠 Home</a>
                <input type="submit" name="submit" value="Add Salesperson" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md font-semibold shadow">
            </div>
        </form>
    </div>
</body>
</html>
