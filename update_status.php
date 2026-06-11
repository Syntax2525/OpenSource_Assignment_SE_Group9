<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/config/db.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header('Location: view_projects.php');
    exit();
}

$stmt = $pdo->prepare('SELECT * FROM projects WHERE id = ?');
$stmt->execute([$id]);
$project = $stmt->fetch();

if (!$project) {
    header('Location: view_projects.php');
    exit();
}

if (isset($_POST['status'])) {
    $status = $_POST['status'];
    $stmt = $pdo->prepare('UPDATE projects SET status = ? WHERE id = ?');
    $stmt->execute([$status, $id]);

    header('Location: view_projects.php');
    exit();
}

$pageTitle = 'Update Status';
require_once __DIR__ . '/includes/header.php';
?>

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Update Project Status</h1>
            <p class="subtitle">Change the status for <?= htmlspecialchars($project['project_name'], ENT_QUOTES, 'UTF-8') ?>.</p>
        </div>
        <a class="button secondary" href="view_projects.php">Back to Projects</a>
    </div>

    <div class="card">
        <form method="POST" class="stacked-form">
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="Pending" <?= $project['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="In Progress" <?= $project['status'] === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                <option value="Completed" <?= $project['status'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
                <option value="Cancelled" <?= $project['status'] === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>

            <button type="submit">Update Status</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>