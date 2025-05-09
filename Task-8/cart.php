<?php
include 'components/header.php';
if (!isset($_SESSION['username'])) {
    header('Location: auth/login.php');
    exit();
}

$stmt = $conn->prepare("SELECT id FROM users WHERE username = :username");
$stmt->execute([":username" => $_SESSION['username']]);
$user = $stmt->fetch();

$user_id = $user['id'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        if (isset($_POST['delete'], $_POST['product_id'])) {
            $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id");
            $stmt->execute([":user_id" => $user_id, ":product_id" => $_POST['product_id']]);
            $_SESSION['success'] = "Product removed from cart.";
        } else {
            $stmt = $conn->prepare("
                INSERT INTO cart (user_id, product_id, quantity) 
                VALUES (:user_id, :product_id, :quantity) 
                ON DUPLICATE KEY UPDATE quantity = quantity + :quantity
            ");
            $stmt->execute([":user_id" => $user_id, ":product_id" => $_POST['product_id'], ":quantity" => $_POST['quantity']]);
            $_SESSION['success'] = "Product added to cart.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Failed: " . $e->getMessage();
    }
    header('Location: cart.php');
    exit();
}

$stmt = $conn->prepare("
    SELECT p.*, c.quantity, (p.price * c.quantity) AS subtotal 
    FROM cart c 
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = :user_id
");
$stmt->execute([":user_id" => $user_id]);
$cartItems = $stmt->fetchAll();
$total = array_sum(array_column($cartItems, 'subtotal'));
?>

<section class="h-100 h-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <?php if (isset($_SESSION['success'])) {
                    echo '<div class="alert alert-success mx-2" role="alert">' . $_SESSION['success'] . '</div>';
                    unset($_SESSION['success']);
                } ?>
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-3"><a href="index.php" class="text-body"><i
                                    class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                        <hr>
                        <?php if ($cartItems): ?>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="mb-1">Shopping cart</p>
                                <p class="mb-0">You have <?= count($cartItems) ?> items in your cart</p>
                            </div>
                            <?php foreach ($cartItems as $product): ?>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <img src="<?= $product['image'] ?>" class="img-fluid rounded-3"
                                                    style="width: 65px;">
                                                <div class="ms-3">
                                                    <h5><?= $product['name'] ?></h5>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center">
                                                <div style="width: 50px;">
                                                    <h5 class="fw-normal mb-0"><?= $product['quantity'] ?></h5>
                                                </div>
                                                <div style="width: 80px;">
                                                    <h5 class="mb-0"><?= $product['price'] ?></h5>
                                                </div>
                                                <form method="post" action="cart.php">
                                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                    <button type="submit" class="btn btn-link text-danger" name="delete"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="d-flex justify-content-between mb-4">
                                <p class="mb-2">Total</p>
                                <p class="mb-2">$<?= $total ?></p>
                            </div>
                            <form method="post" action="orders.php">
                                <button type="submit" name="checkout" class="btn btn-info btn-block btn-lg">
                                    <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                </button>
                            </form>
                        <?php else: ?>
                            <div class="alert alert-info" role="alert">Your cart is empty.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'components/footer.php'; ?>