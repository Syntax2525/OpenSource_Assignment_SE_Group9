<?php
require_once __DIR__ . '/includes/auth.php';

$pageTitle = 'Dashboard';
require_once __DIR__ . '/includes/header.php';
?>

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard</h1>
            <p class="subtitle">Welcome, <?= htmlspecialchars($_SESSION['fullname'], ENT_QUOTES, 'UTF-8') ?>.</p>
        </div>
    </div>

    <div class="card">
        <h2>Quick actions</h2>
        <div class="page-actions">
            <a class="button" href="add_project.php">Add Project</a>
            <a class="button secondary" href="view_projects.php">View Projects</a>
            <a class="button secondary" href="search_project.php">Search Projects</a>
            <a class="button secondary" href="logout.php">Logout</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>