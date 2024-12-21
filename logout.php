<?php
// I certify that this submission is my own original work - Laila Choudhry 
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
