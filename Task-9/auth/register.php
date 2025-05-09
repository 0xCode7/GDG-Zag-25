<?php
include '../components/auth/header.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);

    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
        header('Location: ../index.php');
    } else {
        echo 'Error: ' . $conn->error;
    }
} else if (isset($_SESSION['username'])) {
    header('Location: ../index.php');
}
?>


<div class="container mt-5">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="w-50 m-auto">
        <div class="form-group">
            <label for="usernameInput" class="form-label">Username</label>
            <input type="text" class="form-control" id="usernameInput" placeholder="Enter Username" name="username">
        </div>
        <div class="form-group">
            <label for="emailInput" class="form-label">Email</label>
            <input type="email" class="form-control" id="emailInput" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
            <label for="passwordInput" class="form-label">Password</label>
            <input type="password" class="form-control" id="passwordInput" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary mt-2 w-100">Submit</button>
        <br>
        <p>
            Already have an account?
            <a href="login.php">Login</a>
        </p>
    </form>
</div>
<?php
include '../components/footer.php';
?>