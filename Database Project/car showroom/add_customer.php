<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (isset($_POST['submit'])) {
    $name = $_POST['customername'];
    
    $contact = $_POST['contactnumber'];
    $email = $_POST['email'];
    $cnic = $_POST['cnic'];
    $gender = $_POST['gender'];
    $dob = $_POST['dateofbirth'];
    $address = $_POST['address'];

    $sql = "INSERT INTO customer (customername, contactnumber, email, cnic, gender, dateofbirth, address)
            VALUES ('$name', '$contact', '$email', '$cnic', '$gender', '$dob', '$address')";

    if ($conn->query($sql)) {
        echo "<p class='text-green-700 text-center font-semibold mt-6'>✅ Customer added successfully. <a class='text-blue-600 hover:underline' href='view_customer.php'>Back to List</a></p>";
    } else {
        echo "<p class='text-red-600 text-center font-semibold mt-6'>❌ Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Customer</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: url('https://www.ccu.edu/blogs/cags/uploads/2018/07/car-salesman-talking-to-woman.jpg') no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>
<body class="min-h-screen bg-black bg-opacity-50 text-white">

  <div class="max-w-2xl mx-auto bg-white/90 text-gray-800 mt-16 p-8 rounded-xl shadow-lg">
    <h2 class="text-3xl font-bold text-center mb-6 text-blue-700">👤 Add New Customer</h2>

    <form method="post" class="space-y-5">
      <div>
        <label class="block font-semibold mb-1">Name</label>
        <input type="text" name="customername" required class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      

      <div>
        <label class="block font-semibold mb-1">Contact Number</label>
        <input type="text" name="contactnumber" required class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div>
        <label class="block font-semibold mb-1">Email</label>
        <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div>
        <label class="block font-semibold mb-1">CNIC</label>
        <input type="text" name="cnic" required class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div>
        <label class="block font-semibold mb-1">Gender</label>
        <select name="gender" required class="w-full p-2 border border-gray-300 rounded-md">
          <option value="">-- Select --</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>

      <div>
        <label class="block font-semibold mb-1">Date of Birth</label>
        <input type="text" name="dateofbirth" placeholder="e.g. 05-Jan-2000" required class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div>
        <label class="block font-semibold mb-1">Address</label>
        <input type="text" name="address" class="w-full p-2 border border-gray-300 rounded-md">
      </div>

      <div class="flex justify-between items-center">
        <a href="index.php" class="text-blue-700 hover:underline">🏠 Home</a>
        <input type="submit" name="submit" value="➕ Add Customer" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold shadow">
      </div>
    </form>
  </div>
</body>
</html>
