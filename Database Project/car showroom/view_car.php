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
  <title>View Cars</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('https://img.freepik.com/premium-photo/new-car-showroom_1348720-4867.jpg') no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>
<body class="min-h-screen text-white bg-black bg-opacity-50">

  <div class="min-h-screen p-6 bg-white/80 text-gray-800">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h1 class="text-3xl font-bold text-blue-800">🚘 All Cars in Inventory</h1>
        <a href="add_car.php" class="inline-block mt-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">➕ Add New Car</a>
      </div>
      <div class="space-x-4">
        <a href="index.php" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-white font-semibold shadow">🏠 Home</a>
        <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md text-white font-semibold shadow">🚪 Logout</a>
      </div>
    </div>

    <!-- Search Form -->
    <form method="GET" class="mb-4 flex items-center gap-2">
      <input type="text" name="search" placeholder="Search by name, model, brand..." 
             value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
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
            <th class="py-3 px-4 text-left">Name</th>
            <th class="py-3 px-4 text-left">Model</th>
            <th class="py-3 px-4 text-left">Color</th>
            <th class="py-3 px-4 text-left">Chase #</th>
            <th class="py-3 px-4 text-left">Brand</th>
            <th class="py-3 px-4 text-left">Price</th>
            <th class="py-3 px-4 text-left">Type</th>
            <th class="py-3 px-4 text-left">Stock Qty</th>
            <th class="py-3 px-4 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $conn = new mysqli("localhost", "root", "03120453586", "cars");
        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

        $search = "";
        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $search = $conn->real_escape_string(trim($_GET['search']));
            $query = "SELECT * FROM cars WHERE 
                      name LIKE '%$search%' OR 
                      model LIKE '%$search%' OR 
                      brand LIKE '%$search%'";
        } else {
            $query = "SELECT * FROM cars";
        }

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='border-b hover:bg-gray-100 transition'>
                        <td class='py-3 px-4'>{$row['name']}</td>
                        <td class='py-3 px-4'>{$row['model']}</td>
                        <td class='py-3 px-4'>{$row['color']}</td>
                        <td class='py-3 px-4'>{$row['chasenumber']}</td>
                        <td class='py-3 px-4'>{$row['brand']}</td>
                        <td class='py-3 px-4'>Rs. {$row['price']}</td>
                        <td class='py-3 px-4'>{$row['typeofcar']}</td>
                        <td class='py-3 px-4'>{$row['stockquantity']}</td>
                        <td class='py-3 px-4 space-x-2'>
                          <a href='editcar.php?chasenumber={$row['chasenumber']}' class='text-blue-600 hover:underline'>✏️ Edit</a>
                          <a href='deletecar.php?chasenumber={$row['chasenumber']}' onclick=\"return confirm('Delete this car?')\" class='text-red-600 hover:underline'>🗑 Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='9' class='text-center py-6'>No cars found.</td></tr>";
        }
        $conn->close();
        ?>
        </tbody>
      </table>
    </div>

  </div>
</body>
</html>
