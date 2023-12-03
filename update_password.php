<?php
// Backend file for updating user password, written by John-Bryan Nicdao

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

    // Placeholder for password verification and update logic
    // Example: fetching hashed password from the database using user ID from session
    $userId = $_SESSION['user_id']; // Fetch user ID from session
    $sql = "SELECT password FROM users WHERE id = $userId";
    $result = mysqli_query($mysqli, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $hashedPasswordFromDB = $row['password'];

        // Verify current password against stored hash
        if (password_verify($currentPassword, $hashedPasswordFromDB)) {
            // Password verification successful, hash the new password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the database
            $updateQuery = "UPDATE users SET password = '$hashedNewPassword' WHERE id = $userId";
            $updateResult = mysqli_query($mysqli, $updateQuery);

            if ($updateResult) {
                // Password updated successfully
                header("Location: account_settings.php");
                exit();
            } else {
                // Handle database update error
                echo "Error updating password: " . mysqli_error($mysqli);
            }
        } else {
            // Handle incorrect current password
            echo "Incorrect current password!";
        }
    } else {
        // Handle database query error
        echo "Error fetching user data: " . mysqli_error($mysqli);
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    // Handle if the form wasn't submitted properly
    echo "Invalid request!";
}

// Close the database connection
mysqli_close($mysqli);
?>
