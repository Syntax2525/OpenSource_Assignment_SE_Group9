<?php

session_start();

require_once "config/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare(
        "SELECT * FROM users WHERE email = ?"
    );

    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if (
        $user &&
        password_verify(
            $password,
            $user["password"]
        )
    ) {

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["fullname"] = $user["fullname"];

        header("Location: dashboard.php");
        exit;

    } else {

        $message = "Invalid credentials";

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<p><?php echo $message; ?></p>

<form method="POST">

    <label>Email</label><br>
    <input
        type="email"
        name="email"
        required
    ><br><br>

    <label>Password</label><br>
    <input
        type="password"
        name="password"
        required
    ><br><br>

    <button type="submit">
        Login
    </button>

</form>

<a href="register.php">
    Register
</a>

</body>
</html>