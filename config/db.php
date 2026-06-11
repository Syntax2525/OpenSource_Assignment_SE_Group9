<?php

$host = "localhost";
$port = "3310";
$dbname = "project_tracking_db";
$username = "root";
$password = "Tyson@2525";

try {

    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname",
        $username,
        $password
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch(PDOException $e) {

    die("Connection failed: " . $e->getMessage());

}
?>