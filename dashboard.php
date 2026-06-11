<?php

session_start();

if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>
Welcome,
<?php echo $_SESSION["fullname"]; ?>
</h1>

<hr>

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

</body>
</html>