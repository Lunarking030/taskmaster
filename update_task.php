<?php

//backend file for updating tasks on task page, written by John-Bryan Nicdao

// Start or resume the session
session_start();

// Database connection details
$myserver = "localhost";
$myuserid = "root";
$mypassword = NULL; // Replace with your actual password if set
$mydatabase = "taskmaster";

// Attempt to establish a connection to MySQL
$mysqli = mysqli_connect($myserver, $myuserid, $mypassword, $mydatabase);

// Check if the connection is successful
if (!$mysqli) {
    die('Could not connect to MySQL server: ' . mysqli_connect_error());
}

// Check if form data is received and process task update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated task data from form
    $taskId = $_POST['task_id'];
    $updatedDetails = $_POST['updated_details']; // Update the details accordingly

    // Prepare the UPDATE query to update the task in the 'tasks' table
    $updateQuery = "UPDATE tasks SET task_details = ? WHERE id = ?";

    // Create a prepared statement
    $stmt = mysqli_prepare($mysqli, $updateQuery);

    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "si", $updatedDetails, $taskId);

    // Execute the prepared statement
    $result = mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if ($result) {
        // Task updated successfully, triggers a JavaScript alert
        echo "<script>alert('Task updated successfully!');</script>";
        header("Location: tasks.php");
        exit(); // Ensuring no further code is ran after the redirect
    } else {
        // If the query fails, display an error message
        echo "Error: " . mysqli_error($mysqli);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($mysqli);
?>
