<?php
include 'components/header.php';

$products = $conn->query("SELECT * FROM products")->fetchAll();
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success mx-2" role="alert">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']); 
}
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger mx-2" role="alert">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']); 
}
foreach ($products as $product) {
    ?>

    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?php echo $product['image'] ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?= $product['name'] ?></h5>
            <p class="card-text"><?= $product['description'] ?></p>
            <p class="card-text">$<?= $product['price'] ?></p>
            <?php if (isset($_SESSION['username'])) {
                $user = $conn->query("SELECT * FROM users WHERE username = '{$_SESSION['username']}'")->fetch();

                ?>
                <form method="post" action="cart.php">
                    <!-- Quantity -->               
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <div class="d-flex justify-content-around">
                        <input type="number" class="form-control w-25" id="quantity" name="quantity" value="1">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </div>
                <?php } ?>
                </form>
        </div>
    </div>

    <?php
}
?>

<?php
include 'components/footer.php';
?>