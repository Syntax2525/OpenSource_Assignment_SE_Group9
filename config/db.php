<?php
$host = getenv('DB_HOST') ?: 'localhost';
$ports = [getenv('DB_PORT') ?: '3310', '3306'];
$dbname = 'project_tracking_db';
$username = getenv('DB_USERNAME') ?: 'root';
$password = getenv('DB_PASSWORD') ?: 'Tyson@2525';
$pdo = null;
$lastError = null;

foreach ($ports as $port) {
    try {
        $pdo = new PDO(
            "mysql:host=$host;port=$port;dbname=$dbname",
            $username,
            $password
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        break;
    } catch (PDOException $e) {
        $lastError = $e;
    }
}

if ($pdo === null) {
    die('Connection failed: ' . $lastError->getMessage());
}

$pdo->exec(<<<SQL
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
SQL);

$pdo->exec(<<<SQL
CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(150) NOT NULL,
    description TEXT,
    project_manager VARCHAR(100),
    start_date DATE,
    end_date DATE,
    status ENUM('Pending', 'In Progress', 'Completed', 'Cancelled') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
SQL);
?>