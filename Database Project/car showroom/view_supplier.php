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
    $sql = "SELECT * FROM supplier WHERE 
            supplierid LIKE '%$search%' OR 
            suppliername LIKE '%$search%' OR 
            contactnumber LIKE '%$search%' OR 
            suppliedcar LIKE '%$search%' OR 
            suppliesbrandname LIKE '%$search%' OR 
            address LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM supplier";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Suppliers</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQShfR5ogZT2i2j2WIUlX6oSQpYL05LdPl_iwNddyJVDirJdg35GwIOPuXdnVkbMIBordo&usqp=CAU') no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>
<body class="min-h-screen bg-black bg-opacity-50 text-white">

  <div class="min-h-screen bg-white/80 text-gray-800 p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-3xl font-bold text-blue-800">🚚 All Suppliers</h1>
        <a href="add_supplier.php" class="inline-block mt-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">➕ Add New Supplier</a>
      </div>
      <div class="space-x-4">
        <a href="index.php" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-white font-semibold shadow">🏠 Home</a>
        <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md text-white font-semibold shadow">🚪 Logout</a>
      </div>
    </div>

    <!-- Search Form -->
    <form method="GET" class="mb-4 flex items-center gap-2">
      <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search supplier..."
             class="w-64 px-4 py-2 border rounded-md shadow focus:outline-none focus:ring-2 focus:ring-blue-500">
      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">🔍 Search</button>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto rounded-xl shadow-lg">
      <table class="min-w-full bg-white text-gray-800 text-sm">
        <thead class="bg-blue-700 text-white">
          <tr>
            <th class="py-3 px-4 text-left">ID</th>
            <th class="py-3 px-4 text-left">Name</th>
            <th class="py-3 px-4 text-left">Contact</th>
            <th class="py-3 px-4 text-left">Cars Supplied</th>
            <th class="py-3 px-4 text-left">Brand</th>
            <th class="py-3 px-4 text-left">Address</th>
            <th class="py-3 px-4 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr class='border-b hover:bg-gray-100 transition'>
                          <td class='py-3 px-4'>{$row['supplierid']}</td>
                          <td class='py-3 px-4'>{$row['suppliername']}</td>
                          <td class='py-3 px-4'>{$row['contactnumber']}</td>
                          <td class='py-3 px-4'>{$row['suppliedcar']}</td>
                          <td class='py-3 px-4'>{$row['suppliesbrandname']}</td>
                          <td class='py-3 px-4'>{$row['address']}</td>
                          <td class='py-3 px-4 space-x-2'>
                            <a href='editsupplier.php?id={$row['supplierid']}' class='text-blue-600 hover:underline'>✏️ Edit</a>
                            <a href='deletesupplier.php?id={$row['supplierid']}' onclick=\"return confirm('Delete this supplier?')\" class='text-red-600 hover:underline'>🗑 Delete</a>
                          </td>
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='7' class='text-center py-6'>No suppliers found.</td></tr>";
          }
          $conn->close();
          ?>
        </tbody>
      </table>
    </div>

  </div>
</body>
</html>
