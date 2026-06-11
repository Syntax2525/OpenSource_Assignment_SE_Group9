<?php
require_once "includes/auth.php";
require_once "config/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $project_name = trim($_POST["project_name"]);
    $description = trim($_POST["description"]);
    $project_manager = trim($_POST["project_manager"]);
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    $sql = "INSERT INTO projects
            (project_name, description, project_manager, start_date, end_date)
            VALUES
            (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        $project_name,
        $description,
        $project_manager,
        $start_date,
        $end_date
    ])) {
        $message = "Project added successfully.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Project</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>Add New Project</h2>

<p><?= $message ?></p>

<form method="POST">

    <input type="text"
           name="project_name"
           placeholder="Project Name"
           required>

    <textarea name="description"
              placeholder="Project Description"
              required></textarea>

    <input type="text"
           name="project_manager"
           placeholder="Project Manager"
           required>

    <label>Start Date</label>
    <input type="date"
           name="start_date"
           required>

    <label>End Date</label>
    <input type="date"
           name="end_date"
           required>

    <button type="submit">
        Save Project
    </button>

</form>

<a href="dashboard.php">Back Dashboard</a>

</div>

</body>
</html>