<?php
// I certify that this submission is my own original work - Laila Choudhry 
session_start();
require 'dblogin.php';

try {
    // Connect to the database using application user
    $pdo = new PDO($attr, $user, $pass, $opts);
    echo "Connected to the database successfully.<br>";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$sql = "DROP TABLE IF EXISTS vinyls;
        CREATE TABLE IF NOT EXISTS vinyls (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(128) NOT NULL,
            artist VARCHAR(128) NOT NULL,
            year CHAR(4),
            description TEXT,
            price DECIMAL(10, 2) NOT NULL
        );
        INSERT INTO vinyls (title, artist, year, description, price) VALUES
        ('Abbey Road', 'The Beatles', 1969, 'Classic album by The Beatles. A timeless masterpiece.', 19.99),
        ('Feel Special', 'TWICE', 2019, 'A vibrant pop album with catchy hits from TWICE.', 18.99),
        ('Likey', 'TWICE', 2017, 'Energetic and catchy hit song by TWICE.', 17.99),
        ('Me & You', 'EXID', 2018, 'A popular track by EXID.', 16.99),
        ('Dil Diyan Gallan', 'Atif Aslam', 2017, 'A romantic song.', 15.99),
        ('Dil Diyan Gallan', 'Ali Zafar', 2017, 'Another beautiful version of Dil Diyan Gallan, sung by Ali Zafar.', 15.99);";
$pdo->exec($sql);
echo "Table 'vinyls' created and populated successfully.<br>";

// SQL commands to create the 'users' table
$sql = "DROP TABLE IF EXISTS users;
        CREATE TABLE IF NOT EXISTS users (
            username VARCHAR(32) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            PRIMARY KEY (username)
        );";
$pdo->exec($sql);
echo "Table 'users' created successfully.<br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Database</title>
</head>
<body>
    <h1>Database Setup Complete</h1>
    <p>The vinyls table has been created and records have been added if they didn't already exist.</p>
    <a href="main.php">Back to Main Menu</a>
</body>
</html>




