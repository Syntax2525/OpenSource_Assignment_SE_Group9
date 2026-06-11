<?php
session_start();

if (!empty($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

$pageTitle = 'Home';
require_once __DIR__ . '/includes/header.php';
?>

<div class="container">
    <div class="card hero-card">
        <h1 class="page-title">Software Project Tracking System</h1>
        <p class="subtitle">Track project progress, responsibilities, and deadlines in one clean workspace.</p>
        <div class="page-actions">
            <a class="button" href="login.php">Login</a>
            <a class="button secondary" href="register.php">Create Account</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>