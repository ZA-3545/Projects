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
  <title>View Customers</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('https://www.shutterstock.com/image-photo/man-adult-customer-male-buyer-600nw-2126039087.jpg') no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>
<body class="text-white min-h-screen bg-black bg-opacity-50">

<div class="min-h-screen bg-white/80 text-gray-800 p-6 md:p-10">

  <!-- Header -->
  <div class="flex justify-between items-center mb-6">
    <div>
      <h1 class="text-3xl font-bold text-blue-800">👥 All Customers</h1>
      <a href="add_customer.php" class="inline-block mt-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">➕ Add New Customer</a>
    </div>
    <div class="space-x-4">
      <a href="index.php" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-white font-semibold shadow">🏠 Home</a>
      <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md text-white font-semibold shadow">🚪 Logout</a>
    </div>
  </div>

  
  <!-- Search Form -->
  <form method="GET" class="mb-4 flex items-center gap-2">
    <input type="text" name="search" placeholder="Search..." 
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
          <th class="py-3 px-4 text-left">ID</th>
          <th class="py-3 px-4 text-left">Contact</th>
          <th class="py-3 px-4 text-left">Email</th>
          <th class="py-3 px-4 text-left">CNIC</th>
          <th class="py-3 px-4 text-left">Gender</th>
          <th class="py-3 px-4 text-left">DOB</th>
          <th class="py-3 px-4 text-left">Address</th>
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
          $query = "SELECT * FROM customer WHERE 
                    customername LIKE '%$search%' OR 
                    customerid LIKE '%$search%' OR 
                    email LIKE '%$search%'";
      } else {
          $query = "SELECT * FROM customer";
      }

      $result = $conn->query($query);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr class='border-b hover:bg-gray-100 transition'>
                      <td class='py-3 px-4'>{$row['customername']}</td>
                      <td class='py-3 px-4'>{$row['customerid']}</td>
                      <td class='py-3 px-4'>{$row['contactnumber']}</td>
                      <td class='py-3 px-4'>{$row['email']}</td>
                      <td class='py-3 px-4'>{$row['cnic']}</td>
                      <td class='py-3 px-4'>{$row['gender']}</td>
                      <td class='py-3 px-4'>{$row['dateofbirth']}</td>
                      <td class='py-3 px-4'>{$row['address']}</td>
                      <td class='py-3 px-4 space-x-2'>
                        <a href='editcustomer.php?id={$row['customerid']}' class='text-blue-600 hover:underline'>✏️ Edit</a>
                        <a href='deletecustomer.php?id={$row['customerid']}' onclick=\"return confirm('Delete this customer?')\" class='text-red-600 hover:underline'>🗑 Delete</a>
                      </td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='9' class='text-center py-6'>No customers found.</td></tr>";
      }

      $conn->close();
      ?>
      </tbody>
    </table>
  </div>

</div>
</body>
</html>
