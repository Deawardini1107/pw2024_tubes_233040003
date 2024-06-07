<?php
session_start();
// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to home page or login page
header("Location: /pw2024_tubes_233040003/index.php");
exit;
?>
