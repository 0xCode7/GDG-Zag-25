<?php

require_once 'db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="assets/css/libs/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/libs/fontawesome.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <?php
    if (isset($_SESSION['username'])) {
        include 'navbar.php';
    } else {
        include 'auth/navbar.php';
    }
    ?>

    <div class="container pt-5">