<?php

// logout.php - backend for logging the user out, written by John-Bryan Nicdao

session_start();

// Destroy all session variables
session_unset();
session_destroy();

// Redirect to login page after logout
header("Location: login.php");
exit();
?>
