<?php
include 'header.php';
require_once '../Library.php';
global $conn;

$library = new Library($conn);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    try {
        $library->removeBook($id);
    } catch (Exception $e) {
        $_SESSION['error'] = "Failed to delete product";
    }
}
header('Location: ../index.php');

