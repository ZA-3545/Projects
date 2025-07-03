<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: url('https://www.autotrainingcentre.com/wp-content/uploads/2023/07/July-4-Automoive-School.jpg') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="min-h-screen bg-black bg-opacity-60 text-white">

    <div class="max-w-2xl mx-auto mt-14 bg-white/90 text-gray-800 p-8 rounded-xl shadow-xl">
        <h1 class="text-3xl font-bold text-center text-green-700 mb-6">💳 Record a New Payment</h1>

        <form method="post" class="space-y-5">

            <div>
                <label class="font-semibold block mb-1">Payment ID:</label>
                <input type="text" name="paymentid" required class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div>
                <label class="font-semibold block mb-1">Invoice ID:</label>
                <input type="text" name="invoiceid" required class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div>
                <label class="font-semibold block mb-1">Payment Method:</label>
                <select name="paymentmethod" required class="w-full p-2 border border-gray-300 rounded-md">
                    <option value="">-- Select Method --</option>
                    <option value="cash">Cash</option>
                    <option value="card">Card</option>
                    <option value="debitcard">Debit Card</option>
                    <option value="online">Online</option>
                </select>
            </div>

            <div>
                <label class="font-semibold block mb-1">Payment Date (e.g. 05-June):</label>
                <input type="text" name="paymentdate" required class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div>
                <label class="font-semibold block mb-1">Payment Time (e.g. 14:30):</label>
                <input type="text" name="paymenttime" required class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="index.php" class="text-blue-600 hover:underline">🏠 Home</a>
                <input type="submit" name="submit" value="💰 Submit Payment" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md font-semibold shadow">
            </div>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $conn = new mysqli("localhost", "root", "03120453586", "cars");
            if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

            $sql = "INSERT INTO payment (paymentid, invoiceid, paymentmethod, paymentdate, paymenttime)
                    VALUES (
                        '{$_POST['paymentid']}',
                        '{$_POST['invoiceid']}',
                        '{$_POST['paymentmethod']}',
                        '{$_POST['paymentdate']}',
                        '{$_POST['paymenttime']}'
                    )";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='text-green-700 font-semibold mt-4'>✅ Payment recorded successfully. <a class='text-blue-600 hover:underline' href='view_payment.php'>View Payments</a></p>";
            } else {
                echo "<p class='text-red-600 font-semibold mt-4'>❌ Error: " . $conn->error . "</p>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
