<?php

//backend file for completing tasks in the tasks page, written by John-Bryan Nicdao

// Start or resume the session
session_start();

// Database connection details
$myserver = "localhost";
$myuserid = "root";
$mypassword = NULL; 
$mydatabase = "taskmaster";

// Attempt to establish a connection to MySQL
$mysqli = mysqli_connect($myserver, $myuserid, $mypassword, $mydatabase);

// Check if the connection is successful
if (!$mysqli) {
    die('Could not connect to MySQL server: ' . mysqli_connect_error());
}

// Check if form data is received and process task deletion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve task ID to be deleted from the form
    $taskId = $_POST['task_id'];

    // Prepare the DELETE query to remove the task from the 'tasks' table
    $deleteQuery = "DELETE FROM tasks WHERE id = ?";

    // Create a prepared statement
    $stmt = mysqli_prepare($mysqli, $deleteQuery);

    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "i", $taskId);

    // Execute the prepared statement
    $result = mysqli_stmt_execute($stmt);

    // Check if the query was successful
if ($result) {
    // Task completed successfully, triggers a JavaScript alert
    echo "<script>alert('Task completed!'); window.location.href = 'tasks.php';</script>";
    exit(); // Ensuring no further code is run after the redirect
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