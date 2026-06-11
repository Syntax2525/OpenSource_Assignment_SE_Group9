<?php
require_once "includes/auth.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h1>
Software Project Tracking System
</h1>

<h3>
Welcome <?= $_SESSION["fullname"] ?>
</h3>

<hr><br>

<ul>

<li>
<a href="add_project.php">
Add Project
</a>
</li>

<li>
<a href="view_projects.php">
View Projects
</a>
</li>

<li>
<a href="search_project.php">
Search Projects
</a>
</li>

<li>
<a href="logout.php">
Logout
</a>
</li>

</ul>

</div>

</body>
</html>