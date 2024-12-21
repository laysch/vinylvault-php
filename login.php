<?php
// I certify that this submission is my own original work - Laila Choudhry 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'dblogin.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        header("Location: main.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f9;
            padding: 50px;
        }

        h2 {
            text-align: center;
            color: #FF8DA1;
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

        form {
            max-width: 400px;
            margin: auto;
            padding: 16px;
            border: 3px solid #f1f1f1;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        button {
            background-color: #FF8DA1;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }

        button:hover {
            opacity: 0.8;
        }

        .error {
            color: #FFC7D1;
            text-align: center;
            font-size: 14px;
        }

        .container {
            padding: 16px;
        }

        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #FFC7D1;
            border-radius: 4px;
            text-align: center;
            display: block;
            margin: 10px auto;
        }

        .cancelbtn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

<div class="header">
    <img src="vinyl.png" alt="VinylVault Icon"> 
    <h1>VinylVault</h1>
</div>

<h2>Login</h2>

<form method="POST" action="login.php">
    <div class="container">
        <label for="username"><b>Username</b></label>
        <input type="text" name="username" placeholder="Enter Username" required>

        <label for="password"><b>Password</b></label>
        <input type="password" name="password" placeholder="Enter Password" required>

        <button type="submit">Login</button>
    </div>

    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="container">
        <button type="button" class="cancelbtn" onclick="window.location.href='register.php';">Don't have an account? Sign up</button>
    </div>
</form>

</body>
</html>



