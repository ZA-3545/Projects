<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = "";
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = $conn->real_escape_string(trim($_GET['search']));
    $query = "SELECT * FROM salesperson WHERE 
              salespersonname LIKE '%$search%' OR 
              salespersonid LIKE '%$search%' OR 
              position LIKE '%$search%'";
} else {
    $query = "SELECT * FROM salesperson";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Salespersons</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('https://www.shutterstock.com/image-photo/checking-quality-vehicle-man-consulting-600nw-2290588399.jpg') no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>
<body class="min-h-screen text-white bg-black bg-opacity-50">

  <div class="min-h-screen bg-white/80 text-gray-800 p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-3xl font-bold text-blue-800">👨‍💼 Salesperson List</h1>
        <a href="add_salesperson.php" class="inline-block mt-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">➕ Add New Salesperson</a>
      </div>
      <div class="space-x-4">
        <a href="index.php" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-white font-semibold shadow">🏠 Home</a>
        <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md text-white font-semibold shadow">🚪 Logout</a>
      </div>
    </div>

    <!-- Search Form -->
    <form method="GET" class="mb-4 flex items-center gap-2">
      <input type="text" name="search" placeholder="Search by name, ID, or position..."
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
            <th class="py-3 px-4 text-left">ID</th>
            <th class="py-3 px-4 text-left">Name</th>
            <th class="py-3 px-4 text-left">Contact</th>
            <th class="py-3 px-4 text-left">Email</th>
            <th class="py-3 px-4 text-left">Salary</th>
            <th class="py-3 px-4 text-left">Position</th>
            <th class="py-3 px-4 text-left">CNIC</th>
            <th class="py-3 px-4 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr class='border-b hover:bg-gray-100 transition'>
                          <td class='py-3 px-4'>{$row['salespersonid']}</td>
                          <td class='py-3 px-4'>{$row['salespersonname']}</td>
                          <td class='py-3 px-4'>{$row['contactnumber']}</td>
                          <td class='py-3 px-4'>{$row['email']}</td>
                          <td class='py-3 px-4'>Rs. {$row['salary']}</td>
                          <td class='py-3 px-4'>{$row['position']}</td>
                          <td class='py-3 px-4'>{$row['cnic']}</td>
                          <td class='py-3 px-4 space-x-2'>
                            <a href='editsalesperson.php?id={$row['salespersonid']}' class='text-blue-600 hover:underline font-semibold'>✏️ Edit</a>
                            <a href='deletesalesperson.php?id={$row['salespersonid']}' onclick=\"return confirm('Are you sure you want to delete this salesperson?');\" class='text-red-600 hover:underline font-semibold'>🗑 Delete</a>
                          </td>
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='8' class='text-center py-6'>No salespersons found.</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>

  </div>
</body>
</html>
