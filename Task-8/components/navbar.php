<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-2">


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cart.php">Cart</a>
            </li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orders.php">Orders</a>
            </li>
        </ul>
    </div>

    <div>
        <!-- Login or Logout -->
        <?php
        if (isset($_SESSION['username'])) {
            ?>
            <a class="btn btn-danger" href="auth/logout.php">Logout</a>
            <?php
        } else {
            ?>
            <a class="btn btn-danger" href="auth/login.php">Login</a>
            <?php
        }
        ?>
    </div>

</nav>
<!-- Navbar -->