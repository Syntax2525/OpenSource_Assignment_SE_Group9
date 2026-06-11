<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/config/db.php';

$stmt = $pdo->query('SELECT * FROM projects ORDER BY id DESC');
$projects = $stmt->fetchAll();

$pageTitle = 'Projects';
require_once __DIR__ . '/includes/header.php';
?>

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">All Projects</h1>
            <p class="subtitle">Review current projects and update their status.</p>
        </div>
        <a class="button secondary" href="dashboard.php">Back to Dashboard</a>
    </div>

    <div class="card">
        <?php if (count($projects) > 0): ?>
            <div class="table-wrap">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Manager</th>
                        <th>Status</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Action</th>
                    </tr>

                    <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?= (int) $project['id'] ?></td>
                            <td><?= htmlspecialchars($project['project_name'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($project['project_manager'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><span class="status-pill"><?= htmlspecialchars($project['status'], ENT_QUOTES, 'UTF-8') ?></span></td>
                            <td><?= htmlspecialchars($project['start_date'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($project['end_date'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><a href="update_status.php?id=<?= (int) $project['id'] ?>">Update</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php else: ?>
            <div class="message">No projects found yet.</div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>