<?php

//backend file for updating user profile, written by John-Bryan Nicdao

// Establish your database connection here
session_start();

$myserver = "localhost";
$myuserid = "root";
$mypassword = NULL;
$mydatabase = "taskmaster";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_username'])) {
    // Sanitize and validate the new username
    $newUsername = trim($_POST['new_username']);

    // Add validation here if needed

    // Update the username in the database
    // Perform the SQL query to update the username for the logged-in user
    // Example (assuming you have a users table):
    // $userId = $_SESSION['user_id']; // Fetch user ID from session
    // $sql = "UPDATE users SET username = '$newUsername' WHERE id = $userId";
    // Execute the query using your database connection

    // Redirect back to account settings or home page after updating
    header("Location: account_settings.php");
    exit();
} else {
    // Handle if the form wasn't submitted properly
    echo "Invalid request!";
}
?>
