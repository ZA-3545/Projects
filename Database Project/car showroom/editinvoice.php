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

// Update invoice
if (isset($_POST['update'])) {
    $sql = "UPDATE invoice SET 
        invoicename='{$_POST['invoicename']}',
        customerid='{$_POST['customerid']}',
        salespersonid='{$_POST['salespersonid']}',
        carchasenumber='{$_POST['carchasenumber']}',
        paymentstatus='{$_POST['paymentstatus']}',
        dateofpurchase='{$_POST['dateofpurchase']}',
        totalamount='{$_POST['totalamount']}',
        returnamount='{$_POST['returnamount']}'
        WHERE invoiceid='$id'";

    if ($conn->query($sql)) {
        $message = "<p class='text-green-600 text-center'>✅ Invoice updated. <a href='view_invoice.php' class='text-blue-600 underline'>Back</a></p>";
    } else {
        $message = "<p class='text-red-600 text-center'>❌ Error: {$conn->error}</p>";
    }
}

// Fetch invoice
$row = $conn->query("SELECT * FROM invoice WHERE invoiceid = '$id'")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-2xl">
    <h2 class="text-2xl font-bold text-center mb-6">🧾 Edit Invoice #<?= htmlspecialchars($id) ?></h2>

    <?= $message ?>

    <form method="post" class="space-y-4">
        <div>
            <label class="block font-semibold">Invoice Name:</label>
            <input type="text" name="invoicename" value="<?= $row['invoicename'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Customer ID:</label>
            <input type="text" name="customerid" value="<?= $row['customerid'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Salesperson ID:</label>
            <input type="text" name="salespersonid" value="<?= $row['salespersonid'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Car Chase Number:</label>
            <input type="text" name="carchasenumber" value="<?= $row['carchasenumber'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Payment Status:</label>
            <select name="paymentstatus" class="w-full border p-2 rounded-md">
                <option value="Done" <?= $row['paymentstatus'] == 'Done' ? 'selected' : '' ?>>Done</option>
                <option value="Pending" <?= $row['paymentstatus'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold">Date of Purchase:</label>
            <input type="text" name="dateofpurchase" value="<?= $row['dateofpurchase'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Total Amount:</label>
            <input type="number" name="totalamount" value="<?= $row['totalamount'] ?>" class="w-full border p-2 rounded-md" required>
        </div>

        <div>
            <label class="block font-semibold">Return Amount:</label>
            <input type="number" name="returnamount" value="<?= $row['returnamount'] ?>" class="w-full border p-2 rounded-md">
        </div>

        <div class="flex justify-between pt-4">
            <a href="view_invoice.php" class="text-blue-600 underline">🔙 View Invoices</a>
            <input type="submit" name="update" value="Update Invoice" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 font-semibold">
        </div>
    </form>
</div>

</body>
</html>
