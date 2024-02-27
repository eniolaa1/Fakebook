<?php
session_start();

// Unset the session variable
unset($_SESSION['username']);

// Destroy the session
session_destroy();

// Redirect to the login page or any other page you prefer
header("Location: index.php"); 
exit();
?>
