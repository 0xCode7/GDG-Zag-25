<?php
require_once 'db.php';

$query = $conn->prepare("SELECT * FROM todoList ORDER BY created_at DESC");
$query->execute();
$tasks = $query->fetchAll();
foreach ($tasks as $task) :?>
    <div class="task-card card">
        <h5><?php echo $task['title']; ?></h5>
        <p><?php echo $task['description']; ?></p>
        <small class="text-muted">Created
            on: <?php echo date('F d, Y, g:i a', strtotime($task['created_at'])) ?></small>
    </div>

    <div class="task-action mt-3">
        <button class="btn btn-warning btn-sm edit-btn"
                data-id="<?= $task['id'] ?>"
                data-description="<?= $task['description'] ?>"
                data-title="<?= $task['title'] ?>"
        >
            Edit
        </button>
        <form action="operations.php" method="post" class="d-inline">
            <input type="hidden" name="id" value="<?= $task['id'] ?>">
            <button type="submit" class="btn btn-danger btn-sm" name="deleteTask">Delete</button>
        </form>
    </div>

<?php
endforeach;
?>