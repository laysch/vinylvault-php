<?php
// I certify that this submission is my own original work - Laila Choudhry 
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'dblogin.php';
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $year = $_POST['year'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("INSERT INTO vinyls (title, artist, year, description, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $artist, $year, $description, $price]);
    $message = "Vinyl record added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vinyl</title>
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
        h2 {
            color: #FF8DA1;
            margin-top: 80px;
        }
        form {
            border: 2px solid #f1f1f1;
            border-radius: 8px;
            background-color: white;
            padding: 20px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #FFC7D1;
            color: white;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            opacity: 0.8;
        }
        .back-link {
            margin-top: 10px;
            text-align: center;
        }
        .back-link a {
            color: #FF8DA1;
            text-decoration: none;
            font-size: 14px;
        }
        .message {
            color: #FFC7D1;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="vinyl.png" alt="VinylVault Logo">
        <h1>VinylVault</h1>
    </div>
    <h2>Add Vinyl Record</h2>
    <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>
    <form method="POST" action="add.php">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="artist" placeholder="Artist" required>
        <input type="number" name="year" placeholder="Year" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" name="price" placeholder="Price" required>
        <button type="submit">Add Record</button>
    </form>
    <div class="back-link">
        <a href="main.php">Back to Main Menu</a>
    </div>
</body>
</html>


