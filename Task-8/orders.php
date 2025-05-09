<?php
include 'components/header.php';

$username = $_SESSION['username'] ?? null;
if (!$username) {
    $_SESSION['error'] = "You need to log in first!";
    header("Location: auth/login.php");
    exit();
}

$stmt = $conn->prepare("SELECT id FROM users WHERE username = :username");
$stmt->execute([":username" => $username]);
$user = $stmt->fetch();

if (!$user) {
    $_SESSION['error'] = "User not found!";
    header("Location: auth/login.php");
    exit();
}

$user_id = $user['id'];

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['checkout'])) {
    try {
        $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = :user_id");
        $stmt->execute([":user_id" => $user_id]);
        $cartItems = $stmt->fetchAll();
        print_r($cartItems);

        if (!$cartItems) {
            $_SESSION['error'] = "Your cart is empty!";
            header("Location: cart.php");
            exit();
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $stmt = $conn->prepare("SELECT price FROM products WHERE id = :product_id");
            $stmt->execute([":product_id" => $item['product_id']]);
            $product = $stmt->fetch();
            $price = $product['price'];
            $total += $price * $item['quantity'];
        }

        $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, created_at) VALUES (:user_id, :total_price, NOW())");
        $stmt->execute([":user_id" => $user_id, ":total_price" => $total]);
        $order_id = $conn->lastInsertId();

        if (!$order_id) {
            $_SESSION['error'] = "Order creation failed!";
            header("Location: cart.php");
            exit();
        }

        foreach ($cartItems as $item) {
            $stmt = $conn->prepare("SELECT price FROM products WHERE id = :product_id");
            $stmt->execute([":product_id" => $item['product_id']]);
            $product = $stmt->fetch();
            $price = $product['price'];

            $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) 
                                    VALUES (:order_id, :product_id, :quantity, :price)");
            $stmt->execute([
                ":order_id" => $order_id,
                ":product_id" => $item['product_id'],
                ":quantity" => $item['quantity'],
                ":price" => $price
            ]);
        }

        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
        $stmt->execute([":user_id" => $user_id]);

        $_SESSION['success'] = "Checkout successful! Your order has been placed.";
        header("Location: orders.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Checkout failed: " . $e->getMessage();
        // header("Location: cart.php");
        // exit();
    }
}

// Fetch all user orders
$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC");
$stmt->execute([":user_id" => $user_id]);
$orders = $stmt->fetchAll();
?>

<section class="container mt-5">
    <h2>Your Orders</h2>
    <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['success'] ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php } ?>
    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['error'] ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php } ?>

    <?php if ($orders) { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Products</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) { ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td>$<?= $order['total_price'] ?></td>
                        <td><?= $order['created_at'] ?></td>
                        <td>
                            <?php
                            $stmt = $conn->prepare("SELECT oi.quantity, oi.price, p.name 
                        FROM order_items oi 
                        JOIN products p ON oi.product_id = p.id 
                        WHERE oi.order_id = :order_id");
                            $stmt->execute([":order_id" => $order['id']]);
                            $orderItems = $stmt->fetchAll();
                            ?>
                            <ul>
                                <?php foreach ($orderItems as $item) { ?>
                                    <li><?= $item['quantity'] ?> x <?= $item['name'] ?> - <?= $item['price'] ?></li>
                                <?php } ?>
                            </ul>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No orders found.</p>
    <?php } ?>
</section>

<?php include 'components/footer.php'; ?>