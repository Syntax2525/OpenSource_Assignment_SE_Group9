<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') : 'Project Tracking System' ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container header-content">
            <a class="brand" href="index.php">Project Tracker</a>
            <nav class="top-nav">
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <a href="dashboard.php">Dashboard</a>
                    <a href="add_project.php">Add Project</a>
                    <a href="view_projects.php">View Projects</a>
                    <a href="search_project.php">Search</a>
                    <a href="dashboard_statistics.php">Statistics</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="index.php">Home</a>
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="page-shell">
