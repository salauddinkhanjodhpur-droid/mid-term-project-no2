<?php
// edit.php
include 'db.php';

// agar id nahi mili to index par bhej do
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = (int) $_GET['id'];

// ---------- UPDATE FORM SUBMIT ----------
if (isset($_POST['update_task'])) {
    $title       = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $due_date    = $_POST['due_date'] ?? null;
    $status      = $_POST['status'] ?? 'Pending';

    if (!empty($title)) {
        $update_sql = "UPDATE tasks
                       SET title='$title',
                           description='$description',
                           due_date='$due_date',
                           status='$status'
                       WHERE id=$id";
        $conn->query($update_sql);
    }

    header("Location: index.php");
    exit();
}

// ---------- GET OLD DATA ----------
$task_sql = "SELECT * FROM tasks WHERE id = $id";
$result = $conn->query($task_sql);

if (!$result || $result->num_rows == 0) {
    // agar task nahi mili to index par bhej do
    header("Location: index.php");
    exit();
}

$task = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="app-container">
        <header class="app-header">
            <h1 class="app-title">Edit Task</h1>
        </header>

        <section class="edit-task-section">
            <form class="task-form" method="POST" action="edit.php?id=<?php echo $task['id']; ?>">
                <div class="form-group">
                    <label for="title">Task Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="input"
                        value="<?php echo htmlspecialchars($task['title']); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        class="textarea"
                        rows="3"
                    ><?php echo htmlspecialchars($task['description']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                        class="input"
                        value="<?php echo $task['due_date']; ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="input">
                        <option value="Pending"
                            <?php if ($task['status'] === 'Pending') echo 'selected'; ?>>
                            Pending
                        </option>
                        <option value="Completed"
                            <?php if ($task['status'] === 'Completed') echo 'selected'; ?>>
                            Completed
                        </option>
                    </select>
                </div>

                <button type="submit" name="update_task" class="btn btn-primary">
                    Update Task
                </button>

                <a href="index.php" class="btn btn-secondary">
                    Cancel
                </a>
            </form>
        </section>
    </div>
    <script src="script.js"></script>
</body>
</html>
