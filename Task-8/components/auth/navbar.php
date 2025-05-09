<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-2">

    <ul class="navbar-nav m-auto">
        <li class="nav-item active">
            <a class="nav-link" href="../index.php">Products</a>
        </li>
    </ul>

    <div>
        
    <?php
        if (isset($_SESSION['user'])) {
            ?>
            <a class="btn btn-danger" href="logout.php">Logout</a>
        <?php   
        } else {
            ?>
            <a class="btn btn-primary" href="auth/login.php">Login</a>
            
        <?php
        }
        ?>
    </div>

</nav>
<!-- Navbar -->