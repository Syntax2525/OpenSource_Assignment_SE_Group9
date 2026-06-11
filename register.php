<?php
session_start();

if (!empty($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

require_once __DIR__ . '/config/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);

    try {
        $sql = 'INSERT INTO users (fullname, email, password) VALUES (:fullname, :email, :password)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':fullname' => $fullname,
            ':email' => $email,
            ':password' => $password
        ]);
        $message = 'Registration successful';
    } catch (PDOException $e) {
        $message = 'Email already exists';
    }
}

$pageTitle = 'Register';
require_once __DIR__ . '/includes/header.php';
?>

<div class="container">
    <div class="card auth-card">
        <h1 class="page-title">Create Account</h1>
        <p class="subtitle">Register to start tracking your projects.</p>

        <?php if ($message !== ''): ?>
            <div class="message success"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <form method="POST" class="stacked-form">
            <label for="fullname">Full Name</label>
            <input id="fullname" type="text" name="fullname" required>

            <label for="email">Email</label>
            <input id="email" type="email" name="email" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>

            <button type="submit">Register</button>
        </form>

        <p class="form-link">Already have an account? <a href="login.php">Login</a></p>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>