<?php
include './header.php';
require_once '../Library.php';
global $conn;
$library = new Library($conn);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $library->addBook($title, $author);
    header('Location: ../index.php');
}
?>

<div class="container mt-5 m-auto">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="w-50 m-auto">
        <div class="form-group">
            <label for="titleInput" class="form-label">Book title</label>
            <input type="text" class="form-control" id="titleInput" placeholder="Title" name="title">
        </div>
        <br>
        <div class="form-group">
            <label for="authorInput" class="form-label">Author</label>
            <input type="text" class="form-control" id="authorInput" placeholder="Author" name="author">
        </div>
        <br>

        <button type="submit" class="btn btn-primary mt-2 w-100">Submit</button>

    </form>
</div>

<?php
include '../components/footer.php';
?>
