<?php
session_start();
$conn = new mysqli("localhost", "root", "03120453586", "cars");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (isset($_POST['login'])) {
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE userid = ? AND password = ?");
    $stmt->bind_param("ss", $userid, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['admin'] = $userid;
        header("Location: index.php");
        exit();
    } else {
        $error = "❌ Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
        body {
            background: url('https://t3.ftcdn.net/jpg/00/65/75/68/360_F_65756860_GUZwzOKNMUU3HldFoIA44qss7ZIrCG8I.jpg') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="bg-white p-8 rounded shadow-md w-full max-w-sm">
    <h2 class="text-2xl font-bold text-center text-red-600 mb-6">Admin Login</h2>

    <?php if (isset($error)) echo "<p class='text-red-600 text-sm mb-4 text-center'>$error</p>"; ?>

    <form method="post" class="space-y-4">
      <div>
        <label class="block text-gray-700">User ID:</label>
        <input type="text" name="userid" required class="w-full border p-2 rounded" />
      </div>
      <div>
        <label class="block text-gray-700">Password:</label>
        <input type="password" name="password" required class="w-full border p-2 rounded" />
      </div>
      <div class="text-center">
        <input type="submit" name="login" value="Login" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 cursor-pointer" />
      </div>
    </form>
  </div>
</body>
</html>
