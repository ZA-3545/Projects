
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
<?php
session_start();
session_destroy();
header("Location: login.php");
exit();
?>
