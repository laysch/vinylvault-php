<?php
// I certify that this submission is my own original work - Laila Choudhry 
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VinylVault - Main Menu</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f9;
            padding: 50px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 20px;
        }

        .header img {
            width: 40px; /* Icon size */
            height: 40px;
            margin-right: 10px; /* Space between icon and text */
        }

        .header h1 {
            font-size: 24px;
            color: #FF8DA1; /* Pink color for "VinylVault" */
            margin: 0;
        }

        h2 {
            text-align: center;
            color: #FF8DA1; /* Pink color for Welcome */
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 16px;
            border: 3px solid #f1f1f1;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 20px auto;
        }

        .grid button {
            background-color: #FF8DA1;
            color: white;
            padding: 40px; /* Larger size for square buttons */
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, opacity 0.2s;
        }

        .grid button:hover {
            transform: scale(1.05); /* Slightly enlarge on hover */
            opacity: 0.9;
        }

        .logout-btn {
    background-color: #FFC7D1; /* Light pink for logout */
    color: white;
    padding: 10px 16px; /* Reduce padding for smaller size */
    border: none;
    border-radius: 8px;
    font-size: 14px; /* Slightly smaller font */
    margin-top: 20px;
    width: auto; 

        .logout-btn:hover {
            transform: scale(1.05);
            opacity: 0.9;
        }
    </style>
</head>
<body>

<div class="header">
    <img src="vinyl.png" alt="VinylVault Icon"> <!-- Ensure vinyl.png is in the correct location -->
    <h1>VinylVault</h1>
</div>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

<div class="container">
    <div class="grid">
        <button onclick="window.location.href='list.php';">List Vinyl Records</button>
        <button onclick="window.location.href='add.php';">Add Vinyl Record</button>
        <button onclick="window.location.href='search.php';">Search Vinyl Records</button>
        <button onclick="window.location.href='delete.php';">Delete Vinyl Record</button>
    </div>
    <button class="logout-btn" onclick="window.location.href='logout.php';">Logout</button>
</div>

</body>
</html>


