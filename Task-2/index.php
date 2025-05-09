<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<style>
    form {
        display: flex;
        flex-direction: column;
        width: 300px;
        margin: 0 auto;
    }

    label {
        margin-top: 10px;
    }

    input {
        padding: 5px;
        margin-top: 5px;
    }

    button {
        padding: 5px;
        margin-top: 10px;
    }
</style>

<body>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Add new task</h4>
                </div>
                <div class="card-body">
                    <form action="operations.php" method="post" class="mb-4">
                        <div class="form-group mb-3">
                            <label for="taskTitle">Title</label>
                            <input type="text" name="title" id="taskTitle" placeholder="Task" class="form-control"
                                   required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="taskDescription">Description</label>
                            <input type="text" name="description" id="taskDescription" placeholder="Description"
                                   class="form-control" required>
                        </div>
                        <button type="submit" class="btn add-task-btn btn-success" name="addTask">Add task</button>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h4>Tasks</h4>
                </div>
                <div class="card-body">
                    <?php include 'tasks.php'; ?>
                </div>
            </div>
        </div>
    </div>
    <?php include 'edit-modal.php'; ?>

    <script>
        const editBtns = document.querySelectorAll('.edit-btn');

        editBtns.forEach((btn) => {

            btn.addEventListener('click', function () {
               const id = this.getAttribute("data-id");
               const title = this.getAttribute("data-title");
               const description = this.getAttribute("data-description");

               document.getElementById('editId').value = id;
               document.getElementById('editTitle').value = title;
               document.getElementById('editDescription').value = description;

                const editTaskModal = new bootstrap.Modal(document.getElementById('editTaskModal'));
                editTaskModal.show();
            });
        })
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

