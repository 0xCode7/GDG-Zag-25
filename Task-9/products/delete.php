<?php
include 'header.php';
require_once '../Product.php';
global $conn;

$product = new Product();
if (isset($_SESSION['user'])) {
    $id = $_GET['id'];
    $product->deleteProduct($id);
    if ($product->deleteProduct($id)) {
        $_SESSION['success'] = "Product deleted successfully";
    } else {
        $_SESSION['error'] = "Failed to delete product";
    }
    header('Location: ../index.php');
} else {
    header('Location: ../index.php');

}

