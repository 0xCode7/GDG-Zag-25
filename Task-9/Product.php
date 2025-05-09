<?php
require_once 'db.php';

class Product
{

    public function createProduct($name, $description, $price)
    {
        global $conn;
        if (!isset($_SESSION['user'])) {
            return false;
        }
        $stmt = $conn->prepare("INSERT INTO products (name, description, price) VALUES (:name, :description, :price)");
        return $stmt->execute(['name' => $name, 'description' => $description, 'price' => $price]);
    }

    public function getProducts()
    {

        global $conn;
        $stmt = $conn->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {

        global $conn;
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduct($id, $name, $description, $price)
    {
        session_start();
        global $conn;
        if (!isset($_SESSION['user'])) {
            return false;
        }
        $stmt = $conn->prepare("UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id");
        return $stmt->execute(['name' => $name, 'description' => $description, 'price' => $price, 'id' => $id]);
    }

    public function deleteProduct($id)
    {
        session_start();

        global $conn;

        if (!isset($_SESSION['user'])) {
            return false;
        }
        $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}