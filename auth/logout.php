<?php
session_start();
// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to home page or login page
header("Location: /paradise/index.php");
exit;
?>
