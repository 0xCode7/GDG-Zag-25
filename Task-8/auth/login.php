<?php
include '../components/auth/header.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        header('Location: ../index.php');
    } else {
        ?>
        <div class="alert alert-danger" role="alert">
            Invalid Username or Password
        </div>
        <?php

    }
}else if(isset($_SESSION['username'])){
    header('Location: ../index.php');
}
?>
<div class="container mt-5 m-auto">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="w-50 m-auto">
        <div class="form-group">
            <label for="usernameInput" class="form-label">Username</label>
            <input type="text" class="form-control" id="usernameInput" placeholder="Enter Username" name="username">
        </div>
        <div class="form-group">
            <label for="passwordInput" class="form-label">Password</label>
            <input type="password" class="form-control" id="passwordInput" placeholder="Password" name="password">
        </div>
        <button type="submit" class="btn btn-primary mt-2 w-100">Submit</button>
        <br>
        <p>
            Don't have an account?
            <a href="register.php">Register</a>
        </p>
    </form>
</div>

<?php
include '../components/footer.php';
?>