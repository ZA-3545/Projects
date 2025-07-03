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
  <title>Add Booking</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('https://thumbs.dreamstime.com/b/salesperson-customer-car-dealership-professional-work-shaking-hands-successful-deal-giving-keys-to-new-96181754.jpg') no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>
<body class="min-h-screen bg-black bg-opacity-50 text-white">
  
  <div class="max-w-2xl mx-auto bg-white/90 text-gray-800 mt-16 p-8 rounded-xl shadow-lg">
    <h2 class="text-3xl font-bold text-center mb-6 text-blue-700">🚘 Add Car Booking</h2>

    <form method="post" class="space-y-5">
      

      <div>
        <label class="block font-semibold mb-1">Car Chase Number</label>
        <input type="text" name="carchasenumber" required class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div>
        <label class="block font-semibold mb-1">Car Color</label>
        <input type="text" name="carcolor" required class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div>
        <label class="block font-semibold mb-1">Booking Date</label>
        <input type="text" name="bookingdate" placeholder="e.g. 6-Oct" required class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div>
        <label class="block font-semibold mb-1">Booking Status</label>
        <select name="bookingstatus" class="w-full p-2 border border-gray-300 rounded-md">
          <option value="done">✅ Done</option>
          <option value="not done">❌ Not Done</option>
        </select>
      </div>

      <div class="flex justify-between items-center">
        <a href="index.php" class="text-blue-700 hover:underline">🏠 Home</a>
        <input type="submit" name="submit" value="📦 Book Car" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold shadow">
      </div>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $conn = new mysqli("localhost", "root", "03120453586", "cars");
        if ($conn->connect_error) die("Connection failed");

        $sql = "INSERT INTO booking ( carchasenumber, carcolor, bookingdate, bookingstatus)
                VALUES ( '{$_POST['carchasenumber']}', '{$_POST['carcolor']}',
                        '{$_POST['bookingdate']}', '{$_POST['bookingstatus']}')";

        if ($conn->query($sql)) {
            echo "<p class='mt-4 text-green-700 font-semibold text-center'>✅ Booking added successfully. <a href='view_booking.php' class='text-blue-600 hover:underline'>View All</a></p>";
        } else {
            echo "<p class='mt-4 text-red-600 font-semibold text-center'>❌ Error: {$conn->error}</p>";
        }
        $conn->close();
    }
    ?>
  </div>
</body>
</html>
