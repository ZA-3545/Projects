<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) die("Connection failed");

$search = "";
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = $conn->real_escape_string(trim($_GET['search']));
    $result = $conn->query("SELECT * FROM booking WHERE 
        bookingid LIKE '%$search%' OR 
        carchasenumber LIKE '%$search%' OR 
        carcolor LIKE '%$search%' OR 
        bookingstatus LIKE '%$search%'");
} else {
    $result = $conn->query("SELECT * FROM booking");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Bookings</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('https://media.istockphoto.com/id/1130307955/photo/services-car-engine-machine-concept-automobile-mechanic-repairman-checking-a-car-engine-with.jpg?s=612x612&w=0&k=20&c=vzcv9ZeHno8i34ZK2RNcr0E827ASwjX_UFdQE6B5Rz8=') no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>
<body class="min-h-screen bg-black bg-opacity-50 text-white">

  <div class="min-h-screen bg-white/80 text-gray-800 p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-3xl font-bold text-blue-800">📅 All Bookings</h1>
        <a href="add_booking.php" class="inline-block mt-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">➕ Add New Booking</a>
      </div>
      <div class="space-x-4">
        <a href="index.php" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-white font-semibold shadow">🏠 Home</a>
        <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md text-white font-semibold shadow">🚪 Logout</a>
      </div>
    </div>

    <!-- Search Form -->
    <form method="GET" class="mb-4 flex items-center gap-2">
      <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by ID, Chase #, Color, Status"
             class="w-64 px-4 py-2 border rounded-md shadow focus:outline-none focus:ring-2 focus:ring-blue-500">
      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">🔍 Search</button>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto rounded-xl shadow-lg">
      <table class="min-w-full bg-white text-gray-800 text-sm">
        <thead class="bg-blue-700 text-white">
          <tr>
            <th class="py-3 px-4 text-left">Booking ID</th>
            <th class="py-3 px-4 text-left">Car Chase #</th>
            <th class="py-3 px-4 text-left">Color</th>
            <th class="py-3 px-4 text-left">Date</th>
            <th class="py-3 px-4 text-left">Status</th>
            <th class="py-3 px-4 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  $statusClean = trim(strtolower($row['bookingstatus']));
                  echo "<tr class='border-b hover:bg-gray-100 transition'>
                          <td class='py-3 px-4'>{$row['bookingid']}</td>
                          <td class='py-3 px-4'>{$row['carchasenumber']}</td>
                          <td class='py-3 px-4'>{$row['carcolor']}</td>
                          <td class='py-3 px-4'>{$row['bookingdate']}</td>
                          <td class='py-3 px-4 status-cell'>{$row['bookingstatus']}</td>
                          <td class='py-3 px-4 space-y-1'>
                            <a href='editbooking.php?id={$row['bookingid']}' class='text-blue-600 hover:underline block'>✏️ Edit</a>
                            <a href='deletebooking.php?id={$row['bookingid']}' onclick=\"return confirm('Delete this booking?')\" class='text-red-600 hover:underline block'>🗑 Delete</a>";
                  if ($statusClean !== "done") {
                      echo "<button onclick='markBookingDone(\"{$row['bookingid']}\", this)' class='text-green-700 hover:underline block'>✅ Done</button>";
                  } else {
                      echo "<button onclick='markBookingUndone(\"{$row['bookingid']}\", this)' class='text-yellow-600 hover:underline block'>↩️ Not Done</button>";
                  }
                  echo "</td>
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='6' class='text-center py-6'>No bookings found.</td></tr>";
          }
          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- AJAX Script -->
  <script>
    function markBookingDone(id, btn) {
      if (confirm("Mark this booking as Done?")) {
        fetch('mark_booking_status.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'bookingid=' + encodeURIComponent(id)
        })
        .then(res => res.text())
        .then(data => {
          if (data.trim() === "success") {
            const row = btn.closest('tr');
            row.querySelector('.status-cell').innerText = "Done";
            btn.outerHTML = "<button onclick='markBookingUndone(\"" + id + "\", this)' class='text-yellow-600 hover:underline block'>↩️ Not Done</button>";
          } else {
            alert("Failed to update status.");
          }
        });
      }
    }

    function markBookingUndone(id, btn) {
      if (confirm("Mark this booking as Not Done?")) {
        fetch('mark_booking_status.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'bookingid=' + encodeURIComponent(id) + '&undo=1'
        })
        .then(res => res.text())
        .then(data => {
          if (data.trim() === "success") {
            const row = btn.closest('tr');
            row.querySelector('.status-cell').innerText = "Not Done";
            btn.outerHTML = "<button onclick='markBookingDone(\"" + id + "\", this)' class='text-green-700 hover:underline block'>✅ Done</button>";
          } else {
            alert("Failed to update status.");
          }
        });
      }
    }
  </script>

</body>
</html>
