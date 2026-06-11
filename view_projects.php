<?php
require_once "includes/auth.php";
require_once "config/db.php";

$stmt = $pdo->query(
    "SELECT * FROM projects ORDER BY id DESC"
);

$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Projects</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>All Projects</h2>

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

<?php foreach($projects as $project): ?>

<tr>
    <td><?= $project['id'] ?></td>
    <td><?= $project['project_name'] ?></td>
    <td><?= $project['project_manager'] ?></td>
    <td><?= $project['status'] ?></td>
    <td><?= $project['start_date'] ?></td>
    <td><?= $project['end_date'] ?></td>

    <td>
        <a href="update_status.php?id=<?= $project['id'] ?>">
            Update
        </a>
    </td>
</tr>

<?php endforeach; ?>

</table>

<br>

<a href="dashboard.php">Dashboard</a>

</div>

</body>
</html>