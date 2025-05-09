<?php
include '../components/auth/header.php';
require_once '../User.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user = new User();
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($user->login($username, $password)) {
        header('Location: ../index.php');
    } else {
        echo '<div class="alert alert-danger mx-2" role="alert">Invalid username or password</div>';
    }

}else if(isset($_SESSION['user'])){
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