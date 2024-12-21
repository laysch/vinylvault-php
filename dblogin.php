<?php
// I certify that this submission is my own original work (this file was downloaded from brightspace) - Laila Choudhry 
$host = 'localhost';    
$data = 'bcs350fa24';  
$user = 'userfa24';     
$pass = 'pwdfa24';      
$chrs = 'utf8mb4';
$attr = "mysql:host=$host;dbname=$data;charset=$chrs";
$opts = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($attr, $user, $pass, $opts);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();  // throw error if connection fails
}
?>
