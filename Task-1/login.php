<?php
include('db.php');
session_start();
if (isset($_SESSION['username'])) {
    header('location: home.php');
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $statement = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $statement->bindParam(':username', $username);
    $statement->execute();

    if ($statement->rowCount() == 1) {
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header('location: home.php');
        } else {
            echo "Invalid Credentials";
        }
    } else {
        echo "Failed to login";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div id="wrapper">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="login">Login</button>
        </div>
        <p>
            Not yet a member? <a href="register.php">Sign up</a>
        </p>
    </form>
</div>
</body>
</html>

