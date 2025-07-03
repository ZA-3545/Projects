<?php
$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$search = "";
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = $conn->real_escape_string(trim($_GET['search']));
    $sql = "SELECT * FROM payment WHERE 
              paymentid LIKE '%$search%' OR 
              invoiceid LIKE '%$search%' OR 
              paymentmethod LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM payment";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment List</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('https://www.shutterstock.com/image-photo/close-cropped-man-customer-male-600nw-2487419501.jpg') no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>
<body class="min-h-screen bg-black bg-opacity-50 text-white">

  <div class="min-h-screen bg-white/80 text-gray-800 p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-3xl font-bold text-blue-800">💳 Payment List</h1>
        <a href="add_payment.php" class="inline-block mt-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">+ Record New Payment</a>
      </div>
      <div class="space-x-4">
        <a href="index.php" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-white font-semibold shadow">🏠 Home</a>
        <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md text-white font-semibold shadow">🚪 Logout</a>
      </div>
    </div>

    <!-- Search Bar -->
    <form method="GET" class="mb-4 flex items-center gap-2">
      <input type="text" name="search" placeholder="Search by payment ID, invoice ID, method"
             value="<?php echo htmlspecialchars($search); ?>"
             class="w-64 px-4 py-2 border rounded-md shadow focus:outline-none focus:ring-2 focus:ring-blue-500">
      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
        🔍 Search
      </button>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto rounded-xl shadow-lg">
      <table class="min-w-full bg-white text-gray-800 text-sm">
        <thead class="bg-blue-700 text-white">
          <tr>
            <th class="py-3 px-4 text-left">Payment ID</th>
            <th class="py-3 px-4 text-left">Invoice ID</th>
            <th class="py-3 px-4 text-left">Method</th>
            <th class="py-3 px-4 text-left">Date</th>
            <th class="py-3 px-4 text-left">Time</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr class='border-b hover:bg-gray-100 transition'>
                          <td class='py-3 px-4'>{$row['paymentid']}</td>
                          <td class='py-3 px-4'>{$row['invoiceid']}</td>
                          <td class='py-3 px-4'>{$row['paymentmethod']}</td>
                          <td class='py-3 px-4'>{$row['paymentdate']}</td>
                          <td class='py-3 px-4'>{$row['paymenttime']}</td>
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='5' class='text-center py-6'>No payments found.</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>

  </div>
</body>
</html>
