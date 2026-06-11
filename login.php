<?php
session_start();

if (!empty($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

require_once __DIR__ . '/config/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['fullname'] = $user['fullname'];

        header('Location: dashboard.php');
        exit();
    } else {
        $message = 'Invalid credentials';
    }
}

$pageTitle = 'Login';
require_once __DIR__ . '/includes/header.php';
?>

<div class="container">
    <div class="card auth-card">
        <h1 class="page-title">Login</h1>
        <p class="subtitle">Access your project workspace.</p>

        <?php if ($message !== ''): ?>
            <div class="message error"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <form method="POST" class="stacked-form">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <p class="form-link">No account yet? <a href="register.php">Create one</a></p>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>