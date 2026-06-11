<?php
require_once "config/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $password = password_hash(
        $_POST["password"],
        PASSWORD_DEFAULT
    );

    try {

        $sql = "INSERT INTO users
                (fullname,email,password)
                VALUES
                (:fullname,:email,:password)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':fullname' => $fullname,
            ':email' => $email,
            ':password' => $password
        ]);

        $message = "Registration successful";

    } catch(PDOException $e) {

        $message = "Email already exists";

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>

<h2>User Registration</h2>

<p><?php echo $message; ?></p>

<form method="POST">

    <label>Full Name</label><br>
    <input
        type="text"
        name="fullname"
        required
    ><br><br>

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
        Register
    </button>

</form>

<a href="login.php">
    Login
</a>

</body>
</html>