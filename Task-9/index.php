<?php
include 'components/header.php';
require_once 'db.php';
require_once 'Product.php';
global $conn;
$product = new Product();
$products = $product->getProducts();
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success mx-2" role="alert">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger mx-2" role="alert">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>
    <div class="col-3 m-auto">
        <a class="btn btn-primary" href="products/create.php">
            Add Product
        </a>
    </div>

    <div class="container mt-5">
        <div class="row d-flex gap-2">

            <?php
            foreach ($products as $product) {
                ?>

                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="<?php echo $product['image'] ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['name'] ?></h5>
                        <p class="card-text"><?= $product['description'] ?></p>
                        <p class="card-text">$<?= $product['price'] ?></p>
                        <?php if (isset($_SESSION['user'])) {
                            ?>
                            <a href="products/edit.php?id=<?= $product['id'] ?>" class="btn btn-primary">Edit</a>
                            <a href="products/delete.php?id=<?= $product['id'] ?>" class="btn btn-danger">Delete</a>
                        <?php } else { ?>

                        <?php } ?>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
    </div>


<?php
include 'components/footer.php';
?>