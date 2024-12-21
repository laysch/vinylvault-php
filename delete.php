<?php
// I certify that this submission is my own original work - Laila Choudhry 
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Handle deletion if 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete the record from the database
    require 'dblogin.php';
    $stmt = $pdo->prepare("DELETE FROM vinyls WHERE id = ?");
    $stmt->execute([$id]);
    
    // Redirect after deletion
    header("Location: delete.php");
    exit();
}

// Fetch all vinyl records from the database
require 'dblogin.php';
$stmt = $pdo->query("SELECT * FROM vinyls");
$records = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Records</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f9f9f9;
        }
        .header {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 10px 20px;
            position: absolute;
            top: 0;
            left: 0;
        }
        .header img {
            height: 40px;
            margin-right: 10px;
        }
        .header h1 {
            font-size: 20px;
            margin: 0;
            color: #FF8DA1;
        }
        h1 {
            color: #FF8DA1;
            margin-top: 80px;
        }
        table {
            width: 80%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background-color: #FF8DA1;
            color: white;
        }
        td {
            background-color: #fff;
        }
        a {
            color: #FF8DA1;
            text-decoration: none;
            font-size: 14px;
        }
        .action-link {
            color: #FFC7D1;
            font-size: 14px;
        }
        .back-link {
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="vinyl.png" alt="VinylVault Logo">
        <h1>VinylVault</h1>
    </div>
    <h1>Delete Vinyl Records</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Artist</th>
            <th>Year</th>
            <th>Price</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php foreach ($records as $record): ?>
            <tr>
                <td><?php echo htmlspecialchars($record['title']); ?></td>
                <td><?php echo htmlspecialchars($record['artist']); ?></td>
                <td><?php echo htmlspecialchars($record['year']); ?></td>
                <td><?php echo htmlspecialchars($record['price']); ?></td>
                <td><?php echo htmlspecialchars($record['description']); ?></td>
                <td>
                    <!-- Delete button -->
                    <a href="delete.php?id=<?php echo $record['id']; ?>" class="action-link" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="back-link">
        <a href="list.php">Back to List Records</a>
        <br>
        <a href="main.php">Back to Main Menu</a>
    </div>
</body>
</html>

