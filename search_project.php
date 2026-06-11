<?php
require_once "includes/auth.php";
require_once "config/db.php";

$results = [];

if(isset($_GET["search"])) {

    $keyword = "%" . $_GET["search"] . "%";

    $stmt = $pdo->prepare(
        "SELECT * FROM projects
         WHERE project_name LIKE ?"
    );

    $stmt->execute([$keyword]);

    $results = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Project</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>Search Project</h2>

<form method="GET">

<input type="text"
       name="search"
       placeholder="Enter project name">

<button type="submit">
    Search
</button>

</form>

<br>

<table>

<tr>
    <th>ID</th>
    <th>Project Name</th>
    <th>Status</th>
</tr>

<?php foreach($results as $row): ?>

<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['project_name'] ?></td>
    <td><?= $row['status'] ?></td>
</tr>

<?php endforeach; ?>

</table>

</div>

</body>
</html>