<?php
// I certify that this submission is my own original work - Laila Choudhry 
session_start();
require 'dblogin.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if search term is submitted
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$searchBy = isset($_GET['searchBy']) ? $_GET['searchBy'] : 'title';

// Validate searchBy input to prevent SQL injection
$validColumns = ['title', 'artist', 'year'];
if (!in_array($searchBy, $validColumns)) {
    $searchBy = 'title';
}

// Prepare the query to search vinyls based on the selected filter
$sql = "SELECT * FROM vinyls WHERE $searchBy LIKE ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(["%$searchTerm%"]);
$records = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
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
        h2 {
            color: #FF8DA1;
        }
        form {
            margin: 20px;
            padding: 10px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        select, input[type="text"], input[type="submit"] {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #FF8DA1;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            opacity: 0.8;
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
            background-color: white;
        }
        .back-link {
            margin-top: 20px;
            text-align: center;
        }
        .back-link a {
            color: #FF8DA1;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="vinyl.png" alt="VinylVault Logo">
        <h1>VinylVault</h1>
    </div>
    <h1>Search Vinyl Records</h1>

    <!-- Search form -->
    <form action="" method="GET">
        <label for="searchBy">Search By:</label>
        <select name="searchBy" id="searchBy">
            <option value="title" <?php echo $searchBy === 'title' ? 'selected' : ''; ?>>Name</option>
            <option value="artist" <?php echo $searchBy === 'artist' ? 'selected' : ''; ?>>Artist</option>
            <option value="year" <?php echo $searchBy === 'year' ? 'selected' : ''; ?>>Year</option>
        </select>
        <input type="text" name="search" id="search" value="<?php echo htmlspecialchars($searchTerm); ?>" required>
        <input type="submit" value="Search">
    </form>

    <h2>Search Results</h2>
    <?php if ($records): ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Artist</th>
                <th>Year</th>
                <th>Price</th>
                <th>Description</th>
            </tr>
            <?php foreach ($records as $record): ?>
                <tr>
                    <td><?php echo htmlspecialchars($record['title']); ?></td>
                    <td><?php echo htmlspecialchars($record['artist']); ?></td>
                    <td><?php echo htmlspecialchars($record['year']); ?></td>
                    <td><?php echo htmlspecialchars($record['price']); ?></td>
                    <td><?php echo htmlspecialchars($record['description']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No records found for "<?php echo htmlspecialchars($searchTerm); ?>".</p>
    <?php endif; ?>

    <div class="back-link">
        <a href="main.php">Back to Main Menu</a>
    </div>
</body>
</html>
