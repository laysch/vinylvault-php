<?php
// I certify that this submission is my own original work - Laila Choudhry 
session_start();
require 'dblogin.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Handle sort parameter
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'price_asc';

// Define the sorting criteria
switch ($sort) {
    case 'price_asc':
        $order = 'ORDER BY price ASC';
        break;
    case 'price_desc':
        $order = 'ORDER BY price DESC';
        break;
    case 'year_asc':
        $order = 'ORDER BY year ASC';
        break;
    case 'year_desc':
        $order = 'ORDER BY year DESC';
        break;
    case 'title_asc':
        $order = 'ORDER BY title ASC';
        break;
    case 'title_desc':
        $order = 'ORDER BY title DESC';
        break;
    default:
        $order = 'ORDER BY price ASC'; // Default sorting
}

try {
    // Query to fetch all vinyl records based on sorting order
    $stmt = $pdo->query("SELECT * FROM vinyls $order");
    $records = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Records</title>
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
    <h1>Vinyl Records</h1>

    <!-- Sorting Dropdown -->
    <form method="GET" action="list.php">
        <label for="sort">Sort by: </label>
        <select name="sort" id="sort">
            <option value="price_asc" <?php echo ($sort == 'price_asc') ? 'selected' : ''; ?>>Price: Low to High</option>
            <option value="price_desc" <?php echo ($sort == 'price_desc') ? 'selected' : ''; ?>>Price: High to Low</option>
            <option value="year_asc" <?php echo ($sort == 'year_asc') ? 'selected' : ''; ?>>Year: Oldest to Newest</option>
            <option value="year_desc" <?php echo ($sort == 'year_desc') ? 'selected' : ''; ?>>Year: Newest to Oldest</option>
            <option value="title_asc" <?php echo ($sort == 'title_asc') ? 'selected' : ''; ?>>Title: A to Z</option>
            <option value="title_desc" <?php echo ($sort == 'title_desc') ? 'selected' : ''; ?>>Title: Z to A</option>
        </select>
        <button type="submit">Sort</button>
    </form>

    <table>
        <tr>
            <th>Name</th>
            <th>Artist</th>
            <th>Year</th>
            <th>Price</th>
            <th>Description</th>
        </tr>
        <?php if ($records): ?>
            <?php foreach ($records as $record): ?>
                <tr>
                    <td><?php echo htmlspecialchars($record['title']); ?></td>
                    <td><?php echo htmlspecialchars($record['artist']); ?></td>
                    <td><?php echo htmlspecialchars($record['year']); ?></td>
                    <td><?php echo htmlspecialchars($record['price']); ?></td>
                    <td><?php echo htmlspecialchars($record['description']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">No records found.</td></tr>
        <?php endif; ?>
    </table>

    <div class="back-link">
        <a href="main.php">Back to Main Menu</a>
    </div>
</body>
</html>
