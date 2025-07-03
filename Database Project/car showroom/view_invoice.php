<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$search = "";
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = $conn->real_escape_string(trim($_GET['search']));
    $query = "SELECT * FROM invoice WHERE 
              invoicename LIKE '%$search%' OR 
              invoiceid LIKE '%$search%' OR 
              customerid LIKE '%$search%'";
} else {
    $query = "SELECT * FROM invoice";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Invoices</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('https://media.sciencephoto.com/f0/21/17/73/f0211773-800px-wm.jpg') no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>
<body class="min-h-screen text-white bg-black bg-opacity-50">
  <div class="min-h-screen bg-white/80 text-gray-800 p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-3xl font-bold text-blue-800">🧾 All Invoices</h1>
        <a href="add_invoice.php" class="inline-block mt-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">➕ Create New Invoice</a>
      </div>
      <div class="space-x-4">
        <a href="index.php" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-white font-semibold shadow">🏠 Home</a>
        <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md text-white font-semibold shadow">🚪 Logout</a>
      </div>
    </div>

    <!-- Search Bar -->
    <form method="GET" class="mb-4 flex items-center gap-2">
      <input type="text" name="search" placeholder="Search by invoice name, ID or customer ID..."
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
            <th class="py-3 px-4 text-left">Invoice Name</th>
            <th class="py-3 px-4 text-left">Invoice ID</th>
            <th class="py-3 px-4 text-left">Customer ID</th>
            <th class="py-3 px-4 text-left">Salesperson ID</th>
            <th class="py-3 px-4 text-left">Chase #</th>
            <th class="py-3 px-4 text-left">Status</th>
            <th class="py-3 px-4 text-left">Date</th>
            <th class="py-3 px-4 text-left">Total</th>
            <th class="py-3 px-4 text-left">Return</th>
            <th class="py-3 px-4 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  $statusClean = trim(strtolower($row['paymentstatus']));
                  echo "<tr class='border-b hover:bg-gray-100 transition'>
                          <td class='py-3 px-4'>{$row['invoicename']}</td>
                          <td class='py-3 px-4'>{$row['invoiceid']}</td>
                          <td class='py-3 px-4'>{$row['customerid']}</td>
                          <td class='py-3 px-4'>{$row['salespersonid']}</td>
                          <td class='py-3 px-4'>{$row['carchasenumber']}</td>
                          <td class='py-3 px-4 status-cell'>{$row['paymentstatus']}</td>
                          <td class='py-3 px-4'>{$row['dateofpurchase']}</td>
                          <td class='py-3 px-4 text-green-700 font-semibold'>Rs. {$row['totalamount']}</td>
                          <td class='py-3 px-4 text-red-500'>Rs. {$row['returnamount']}</td>
                          <td class='py-3 px-4 space-y-1'>
                            <a href='editinvoice.php?id={$row['invoiceid']}' class='text-blue-600 hover:underline block'>✏️ Edit</a>
                            <a href='deleteinvoice.php?id={$row['invoiceid']}' onclick=\"return confirm('Delete this invoice?')\" class='text-red-600 hover:underline block'>🗑 Delete</a>";
                            
                  if ($statusClean !== "done") {
                      echo "<button onclick='markDone(\"{$row['invoiceid']}\", this)' class='text-green-700 hover:underline block'>✅ Done</button>";
                  } else {
                      echo "<button onclick='markUndone(\"{$row['invoiceid']}\", this)' class='text-yellow-600 hover:underline block'>↩️ Not Done</button>";
                  }
                  echo "</td>
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='10' class='text-center py-6'>No invoices found.</td></tr>";
          }
          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- AJAX Script -->
  <script>
    function markDone(invoiceId, btn) {
      if (confirm("Mark this invoice as Done?")) {
        fetch('mark_done.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'invoiceid=' + encodeURIComponent(invoiceId)
        })
        .then(response => response.text())
        .then(data => {
          if (data.trim() === "success") {
            const row = btn.closest('tr');
            row.querySelector('.status-cell').innerText = "Done";
            btn.outerHTML = "<button onclick='markUndone(\"" + invoiceId + "\", this)' class='text-yellow-600 hover:underline block'>↩️ Not Done</button>";
          } else {
            alert("Failed to update status.");
          }
        });
      }
    }

    function markUndone(invoiceId, btn) {
      if (confirm("Mark this invoice as Not Done?")) {
        fetch('mark_done.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'invoiceid=' + encodeURIComponent(invoiceId) + '&undo=1'
        })
        .then(response => response.text())
        .then(data => {
          if (data.trim() === "success") {
            const row = btn.closest('tr');
            row.querySelector('.status-cell').innerText = "Not Done";
            btn.outerHTML = "<button onclick='markDone(\"" + invoiceId + "\", this)' class='text-green-700 hover:underline block'>✅ Done</button>";
          } else {
            alert("Failed to update status.");
          }
        });
      }
    }
  </script>
</body>
</html>
