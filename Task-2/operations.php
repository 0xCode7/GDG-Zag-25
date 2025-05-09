<?php
require_once 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add new task
    if (isset($_POST['addTask'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $query = $conn->prepare("INSERT INTO todoList (title, description) VALUES (?,?)");;
        $query->execute([$title, $description]);


        header('Location: index.php');
        exit();

    }
    // Update task
    if (isset($_POST['updateTask'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $query = $conn->prepare("UPDATE todoList SET title = ?, description = ? WHERE id = ?");
        $query->execute([$title, $description, $id]);

        header('Location: index.php');
        exit();
    }
    // Delete task
    if (isset($_POST['deleteTask'])) {
        $id = $_POST['id'];
        $query = $conn->prepare("DELETE FROM todoList WHERE id = ?");
        $query->execute([$id]);

        header('Location: index.php');
        exit();
    }
}