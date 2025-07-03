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
    <title>Create Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      body {
        background: url('https://img.freepik.com/premium-photo/salesperson-held-key-handed-it-customer-after-deal-was-successful-ideas-renting-car-buying-car_112699-1300.jpg') no-repeat center center fixed;
        background-size: cover;
      }
    </style>
</head>
<body class="min-h-screen bg-black bg-opacity-60 text-white">

    <div class="max-w-3xl mx-auto mt-14 bg-white/90 text-gray-800 p-8 rounded-xl shadow-xl">
        <h1 class="text-3xl font-bold text-center text-blue-700 mb-6">🧾 Create New Invoice</h1>

        <form method="post" class="space-y-5">

            <div>
                <label class="font-semibold block mb-1">Invoice Name:</label>
                <input type="text" name="invoicename" required class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div>
                <label class="font-semibold block mb-1">Invoice ID:</label>
                <input type="text" name="invoiceid" required class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div>
                <label class="font-semibold block mb-1">Customer ID:</label>
                <input type="text" name="customerid" required class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div>
                <label class="font-semibold block mb-1">Salesperson ID:</label>
                <input type="text" name="salespersonid" required class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div>
                <label class="font-semibold block mb-1">Car Chase Number:</label>
                <input type="text" name="carchasenumber" required class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div>
                <label class="font-semibold block mb-1">Payment Status:</label>
                <select name="paymentstatus" class="w-full p-2 border border-gray-300 rounded-md">
                    <option value="Done">Done</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>

            <div>
                <label class="font-semibold block mb-1">Date of Purchase:</label>
                <input type="text" name="dateofpurchase" placeholder="dd-month" required class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div>
                <label class="font-semibold block mb-1">Total Amount:</label>
                <input type="number" name="totalamount" required class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div>
                <label class="font-semibold block mb-1">Return Amount (if any):</label>
                <input type="number" name="returnamount" value="0" class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="index.php" class="text-blue-700 hover:underline">🏠 Home</a>
                <input type="submit" name="submit" value="➕ Create Invoice" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold shadow">
            </div>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $conn = new mysqli("localhost", "root", "03120453586", "cars");
            if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

            $sql = "INSERT INTO invoice (invoicename, invoiceid, customerid, salespersonid, carchasenumber, 
                    paymentstatus, dateofpurchase, totalamount, returnamount)
                    VALUES (
                        '{$_POST['invoicename']}',
                        '{$_POST['invoiceid']}',
                        '{$_POST['customerid']}',
                        '{$_POST['salespersonid']}',
                        '{$_POST['carchasenumber']}',
                        '{$_POST['paymentstatus']}',
                        '{$_POST['dateofpurchase']}',
                        '{$_POST['totalamount']}',
                        '{$_POST['returnamount']}'
                    )";

            if ($conn->query($sql)) {
                echo "<p class='text-green-700 font-semibold mt-4'>✅ Invoice created successfully. <a class='text-blue-600 hover:underline' href='view_invoice.php'>View All Invoices</a></p>";
            } else {
                echo "<p class='text-red-600 font-semibold mt-4'>❌ Error: {$conn->error}</p>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
