<?php

// Backend file for updating user profile, written by John-Bryan Nicdao

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

    // Placeholder for updating username in the database
    // Example: fetching user ID from session and updating username in the database
    $userId = $_SESSION['user_id']; // Fetch user ID from session
    $mysqli = mysqli_connect($myserver, $myuserid, $mypassword, $mydatabase);

    if ($mysqli) {
        $updateQuery = "UPDATE users SET username = '$newUsername' WHERE id = $userId";
        $updateResult = mysqli_query($mysqli, $updateQuery);

        if ($updateResult) {
            // Username updated successfully
            header("Location: account_settings.php");
            exit();
        } else {
            // Handle database update error
            echo "Error updating username: " . mysqli_error($mysqli);
        }

        // Close the database connection
        mysqli_close($mysqli);
    } else {
        // Handle database connection error
        echo "Could not connect to MySQL server: " . mysqli_connect_error();
    }
} else {
    // Handle if the form wasn't submitted properly
    echo "Invalid request!";
}
?>
