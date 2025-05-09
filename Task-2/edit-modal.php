<div class="modal fade" id="editTaskModal" tabindex="-1" aria-hidden="true" aria-labelledby="editTaskModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="operations.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editId">

                    <div class="mb-3">
                        <label for="editTitle" class="form-label">
                            Title
                        </label>
                        <input type="text" name="title" id="editTitle" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="editDescription" class="form-label">
                            Description
                        </label>
                        <input type="text" name="description" id="editDescription" class="form-control">
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="updateTask">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>