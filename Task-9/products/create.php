<?php
include 'header.php';
require_once '../Product.php';
global $conn;
$product = new Product();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $product->createProduct($name, $description, $price);
    header('Location: ../index.php');
}
?>

<div class="container mt-5 m-auto">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="w-50 m-auto">
        <div class="form-group">
            <label for="nameInput" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="nameInput" placeholder="Name" name="name">
        </div>
        <br>
        <div class="form-group">
            <label for="descriptionInput" class="form-label">Product Description</label>
            <input type="text" class="form-control" id="descriptionInput" placeholder="Description" name="description">
        </div>
        <br>

        <div class="form-group">
            <label for="priceInput" class="form-label">Product Price</label>
            <input type="text" class="form-control" id="priceInput" placeholder="Price" name="price">
        </div>
        <br>

        <button type="submit" class="btn btn-primary mt-2 w-100">Submit</button>

    </form>
</div>

<?php
include '../components/footer.php';
?>
