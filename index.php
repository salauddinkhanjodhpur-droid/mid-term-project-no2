<?php
// index.php
include 'db.php';

// ---------- CREATE (Add new task) ----------
if (isset($_POST['add_task'])) {
    $title       = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $due_date    = $_POST['due_date'] ?? null;

    // simple validation (optional)
    if (!empty($title)) {
        $sql = "INSERT INTO tasks (title, description, due_date)
                VALUES ('$title', '$description', '$due_date')";
        $conn->query($sql);
    }

    // refresh page to avoid form resubmission
    header("Location: index.php");
    exit();
}

// ---------- READ (Get all tasks) ----------
$tasks_sql = "SELECT * FROM tasks ORDER BY created_at DESC";
$tasks = $conn->query($tasks_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="app-container">
        <header class="app-header">
            <h1 class="app-title">Task Manager</h1>
            <p class="app-subtitle">Simple CRUD mini project (PHP + MySQL)</p>
        </header>

        <!-- Add Task Section -->
        <section class="add-task-section">
            <h2 class="section-title">Add New Task</h2>
            <form class="task-form" method="POST" action="index.php">
                <div class="form-group">
                    <label for="title">Task Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="input"
                        placeholder="Enter task title"
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
                        placeholder="Enter task description (optional)"
                    ></textarea>
                </div>

                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                        class="input"
                    >
                </div>

                <button type="submit" name="add_task" class="btn btn-primary">
                    Add Task
                </button>
            </form>
        </section>

        <!-- Task List Section -->
        <section class="task-list-section">
            <h2 class="section-title">All Tasks</h2>
            <div class="table-wrapper">
            <table class="task-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($tasks && $tasks->num_rows > 0): ?>
                    <?php while ($row = $tasks->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($row['description'])); ?></td>
                            <td><?php echo $row['due_date']; ?></td>
                            <td class="status-cell"><?php echo $row['status']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <a
                                    class="btn btn-small btn-edit"
                                    href="edit.php?id=<?php echo $row['id']; ?>"
                                >
                                    Edit
                                </a>

                                <a
                                    class="btn btn-small btn-delete"
                                    href="delete.php?id=<?php echo $row['id']; ?>"
                                >
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No tasks found. Add your first task!</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div>
        </section>
    </div>
    <script src="script.js"></script>
</body>
</html>
