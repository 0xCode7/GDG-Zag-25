<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div id="wrapper">
    <h2>Hello <?php echo $username ?></h2>
    <p>Welcome to the home page</p>
    <p><a href="logout.php">Logout</a></p>
</div>
</body>
</html>
