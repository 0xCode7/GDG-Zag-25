<?php
include 'components/header.php';
require_once 'db.php';
require_once 'Library.php';
require_once 'Book.php';
global $conn;
$library = new Library($conn);

if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success mx-2" role="alert">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger mx-2" role="alert">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}

// Handle search or show available books
$books = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['keyword'])) {
        $books = $library->findBook($_POST['keyword']); // Search for books
    } else {
        $status = $library->getStatus($_POST['id'])['isAvailable'];
        echo $status;
        $library->updateBookStatus($_POST['id'], $status);
    }
} else {
    $books = $library->getBooks();
}
?>

<form method="post" action="">
    <div class="input-group mb-3 gap-1">
        <label type="hidden" for="search"></label>
        <input type="text" class="form-control rounded-2" id="search" placeholder="Search using title or author..."
               name="keyword"
               value="<?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['keyword'])) {
                   echo $_POST['keyword'];
               } else {
                   echo '';
               } ?>">
        <div class="input-group-append">
            <button class="btn btn-success" type="submit">Search</button>
        </div>
    </div>
</form>

<div class="container mt-5">
    <div class="row d-flex gap-2">
        <table class="table table-hover">
            <thead class="thead-dark bg-dark">
            <tr class="table-dark">
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Is Available</th>
                <th scope="col">Operations</th>
            </tr>
            </thead>
            <tbody>

            <?php
            if (!empty($books)) {
                foreach ($books as $book) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $book['id'] ?></th>
                        <td><?php echo $book['title'] ?></td>
                        <td><?php echo $book['author'] ?></td>
                        <td><?php echo($book['isAvailable'] == 1 ? '✅' : '❌') ?></td>
                        <td class="d-flex gap-1">
                            <form method="post" action="books/delete.php">
                                <input type="hidden" value="<?php echo $book['id'] ?>" name="id">
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>

                            <form method="post" action="">
                                <input type="hidden" value="<?php echo $book['id'] ?>" name="id">
                                <?php if ($book['isAvailable'] == '0') { ?>
                                    <button class="btn btn-primary" type="submit">
                                        Borrow
                                    </button>
                                <?php } else { ?>
                                    <button class="btn btn-success" type="submit">
                                        Return
                                    </button>
                                <?php } ?>
                            </form>
                        </td>
                    </tr>
                    <?php

                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No Available books found.</td></tr>";
            }
            ?>

            </tbody>
        </table>

    </div>
</div>

<?php
include 'components/footer.php';
?>
