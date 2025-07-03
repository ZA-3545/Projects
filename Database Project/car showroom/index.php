<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) die("Connection failed");

$total_customers = $conn->query("SELECT COUNT(*) as total FROM customer")->fetch_assoc()['total'];
$total_cars = $conn->query("SELECT COUNT(*) as total FROM cars")->fetch_assoc()['total'];
$total_invoices = $conn->query("SELECT COUNT(*) as total FROM invoice")->fetch_assoc()['total'];
$total_payments = $conn->query("SELECT SUM(totalamount) as total FROM invoice")->fetch_assoc()['total'];
$stock_cars = $conn->query("SELECT SUM(stockquantity) as total FROM cars")->fetch_assoc()['total'];
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Car Showroom Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
            background-image: url('https://apollointeriors.com/wp-content/uploads/2019/01/Lamborghini-showroom-018-1024x633-1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.85);
            min-height: 100vh;
        }
  </style>
</head>
<body class="min-h-screen text-white bg-black bg-opacity-50">

  <!-- Overlay Container -->
  
    <div class="overlay px-4 py-6">
    <!-- Header Section -->
    <header class="text-center mb-10">
      <img src="https://cdn-icons-png.flaticon.com/512/743/743007.png" class="w-20 mx-auto mb-4" alt="Car Logo">
      <h1 class="text-4xl font-extrabold">🚗 Car Showroom Dashboard</h1>
      <p class="text-lg text-gray-200">Your business control panel</p>
    </header>

    <!-- Stats -->
    <section class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-12">
      <div class="glass p-6 rounded-2xl text-center shadow-lg hover:scale-105 transition">
        <h2 class="text-sm text-gray-300">Total Customers</h2>
        <p class="text-2xl font-bold text-black-300"><?= $total_customers ?></p>
      </div>
      <div class="glass p-6 rounded-2xl text-center shadow-lg hover:scale-105 transition">
        <h2 class="text-sm text-gray-300">Total Cars</h2>
        <p class="text-2xl font-bold text-black-300"><?= $total_cars ?></p>
      </div>
      <div class="glass p-6 rounded-2xl text-center shadow-lg hover:scale-105 transition">
        <h2 class="text-sm text-gray-300">Total Invoices</h2>
        <p class="text-2xl font-bold text-black-300"><?= $total_invoices ?></p>
      </div>
      <div class="glass p-6 rounded-2xl text-center shadow-lg hover:scale-105 transition">
        <h2 class="text-sm text-gray-300">Cars in Stock</h2>
        <p class="text-2xl font-bold text-black-300"><?= $stock_cars ?></p>
      </div>
      <div class="glass p-6 rounded-2xl text-center shadow-lg hover:scale-105 transition">
        <h2 class="text-sm text-gray-300">Total Revenue</h2>
        <p class="text-2xl font-bold text-black-400">Rs. <?= number_format($total_payments) ?></p>
      </div>
    </section>

    <!-- Navigation Buttons -->
    <section class="max-w-6xl mx-auto">
      <h2 class="text-2xl font-semibold text-center mb-6 text-white">📂 Manage Sections</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <?php
        $buttons = [
          ['add_customer.php', '➕ Add Customer'],
          ['view_customer.php', '👥 View Customers'],
          ['add_car.php', '➕ Add Car'],
          ['view_car.php', '🚘 View Cars'],
          ['add_salesperson.php', '➕ Add Salesperson'],
          ['view_salesperson.php', '👨‍💼 View Salespersons'],
          ['add_showroom.php', '➕ Add Showroom'],
          ['view_showroom.php', '🏢 View Showrooms'],
          ['add_invoice.php', '➕ Add Invoice'],
          ['view_invoice.php', '🧾 View Invoices'],
          ['add_payment.php', '➕ Add Payment'],
          ['view_payment.php', '💳 View Payments'],
          ['add_booking.php', '➕ Book Car'],
          ['view_booking.php', '📅 View Bookings'],
          ['add_supplier.php', '➕ Add Supplier'],
          ['view_supplier.php', '🚚 View Suppliers'],
          ['add_stock.php', '➕ Add Stock'],
          ['view_stock.php', '📦 View Stock']
        ];

        foreach ($buttons as $btn) {
          echo '<a href="' . $btn[0] . '" class="glass hover:bg-blue-700 text-white text-center py-3 px-4 rounded-lg shadow transition-all">' . $btn[1] . '</a>';
        }
        ?>
      </div>
    </section>

    <!-- Logout -->
    <div class="text-center mt-10">
      <a href="logout.php" class="bg-red-600 hover:bg-red-700 py-2 px-6 rounded-full text-white font-semibold transition shadow-lg">🚪 Logout</a>
    </div>
  </div>
</body>
</html>
