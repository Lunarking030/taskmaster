<?php

//backend file for updating user password, written by John-Bryan Nicdao

// Establish your database connection here
session_start();

$myserver = "localhost";
$myuserid = "root";
$mypassword = NULL;
$mydatabase = "taskmaster";

$mysqli = mysqli_connect($myserver, $myuserid, $mypassword, $mydatabase)
    or die('Could not connect to MySQLI server!' . mysqli_connect_error());

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['current_password']) && isset($_POST['new_password'])) {
    // Sanitize and validate the passwords
    $currentPassword = trim($_POST['current_password']);
    $newPassword = trim($_POST['new_password']);

    // Add validation here if needed

    // Check the current password (example check; you should hash and compare with stored hash)
    // $userId = $_SESSION['user_id']; // Fetch user ID from session
    // $sql = "SELECT password FROM users WHERE id = $userId";
    // Execute the query using your database connection and retrieve the stored hash
    // Compare the current password with the stored hash using password_verify()

    // If password verification is successful:
    // Update the password in the database
    // Hash the new password before storing it (use password_hash())
    // Perform the SQL query to update the password for the logged-in user
    // Example (assuming you have a users table):
    // $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    // $sql = "UPDATE users SET password = '$hashedPassword' WHERE id = $userId";
    // Execute the query using your database connection

    // Redirect back to account settings or home page after updating
    header("Location: account_settings.php");
    exit();
} else {
    // Handle if the form wasn't submitted properly
    echo "Invalid request!";
}
?>
