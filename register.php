<?php
// I certify that this submission is my own original work - Laila Choudhry 

require 'dblogin.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    

    if (strlen($username) < 6) {
        $error = "Username must be at least 6 characters long.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $error = "Password must be at least 8 characters and contain one uppercase letter, one lowercase letter, and one number.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else { //checking to see if user name exists already
        require 'dblogin.php';
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            $error = "Username already taken.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $password_hash]);
            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
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
            width: 40px; /* Adjust size of the icon */
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
            border: 3px solid ##FF8DA1;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input[type=text], input[type=email], input[type=password] {
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

<script>
        // JavaScript to check if passwords match
        function validatePasswords() {
            var password = document.getElementsByName('password')[0].value;
            var confirmPassword = document.getElementsByName('confirm_password')[0].value;

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>
</head>
<body>

<div class="header">
    <img src="vinyl.png" alt="VinylVault Icon"> 
    <h1>VinylVault</h1>
</div>

<h2>Sign Up</h2>

<form method="POST" action="register.php">
    <div class="container">
        <label for="username"><b>Username</b></label>
        <input type="text" name="username" placeholder="Enter Username" required>

        <label for="email"><b>Email</b></label>
        <input type="email" name="email" placeholder="Enter Email" required>

        <label for="password"><b>Password</b></label>
        <input type="password" name="password" placeholder="Enter Password" required>

        <label for="confirm_password"><b>Confirm Password</b></label>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>

        <button type="submit">Sign Up</button>
    </div>
    
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div class="container">
        <button type="button" class="cancelbtn" onclick="window.location.href='login.php';">Already have an account? Log in.</button>
    </div>
</form>

</body>
</html>


