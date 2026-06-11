<?php
require_once "includes/auth.php";
require_once "config/db.php";

$id = $_GET["id"];

if(isset($_POST["status"])) {

    $status = $_POST["status"];

    $stmt = $pdo->prepare(
        "UPDATE projects
         SET status = ?
         WHERE id = ?"
    );

    $stmt->execute([
        $status,
        $id
    ]);

    header("Location: view_projects.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Status</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>Update Project Status</h2>

<form method="POST">

<select name="status">

<option value="Pending">
Pending
</option>

<option value="In Progress">
In Progress
</option>

<option value="Completed">
Completed
</option>

<option value="Cancelled">
Cancelled
</option>

</select>

<button type="submit">
Update Status
</button>

</form>

</div>

</body>
</html>