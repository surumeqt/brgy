<?php
// File: database.config.php
// Description: This file contains the database configuration for connecting to a MySQL database using PDO.
// Database configuration
// IMPORTANT: Replace these with your actual database credentials
$db_host = "localhost";
$db_name = "brgy_newkalalake_lgu";
$db_user = "root";
$db_pass = "";

try {
    // Establish database connection using PDO
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions
} catch (PDOException $e) {
    // Handle database connection errors
    // In a production environment, you might log this error and show a generic message to the user.
    die("Database connection failed: " . $e->getMessage());
}
?>
