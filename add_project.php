<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/config/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_name = trim($_POST['project_name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $project_manager = trim($_POST['project_manager'] ?? '');
    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';

    $sql = 'INSERT INTO projects (project_name, description, project_manager, start_date, end_date) VALUES (?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$project_name, $description, $project_manager, $start_date, $end_date])) {
        $message = 'Project added successfully.';
    }
}

$pageTitle = 'Add Project';
require_once __DIR__ . '/includes/header.php';
?>

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Add New Project</h1>
            <p class="subtitle">Capture project details and track progress.</p>
        </div>
    </div>

    <div class="card">
        <?php if ($message !== ''): ?>
            <div class="message success"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <form method="POST" class="stacked-form">
            <label for="project_name">Project Name</label>
            <input id="project_name" type="text" name="project_name" placeholder="Project Name" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Project Description" required></textarea>

            <label for="project_manager">Project Manager</label>
            <input id="project_manager" type="text" name="project_manager" placeholder="Project Manager" required>

            <label for="start_date">Start Date</label>
            <input id="start_date" type="date" name="start_date" required>

            <label for="end_date">End Date</label>
            <input id="end_date" type="date" name="end_date" required>

            <div class="page-actions">
                <button type="submit">Save Project</button>
                <a class="button secondary" href="dashboard.php">Back to Dashboard</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>