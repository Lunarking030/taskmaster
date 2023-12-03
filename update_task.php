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
    $updatedTaskName = $_POST['updated_task_name'];
    $updatedDetails = $_POST['updated_details'];
    $updatedDueDate = $_POST['updated_due_date'];
    $updatedPriority = $_POST['updated_priority'];

   // Prepare the UPDATE query to update multiple fields in the 'tasks' table
    $updateQuery = "UPDATE tasks SET task_name = ?, task_details = ?, due_date = ?, priority = ? WHERE id = ?";

    // Create a prepared statement
    $stmt = mysqli_prepare($mysqli, $updateQuery);

    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "ssssi", $updatedTaskName, $updatedDetails, $updatedDueDate, $updatedPriority, $taskId);

    // Assuming $updatedTaskName, $updatedDueDate, and $updatedPriority are retrieved from your form inputs
    // Execute the prepared statement
    $result = mysqli_stmt_execute($stmt);


    // Check if the query was successful
if ($result) {
    // Task updated successfully, triggers a JavaScript alert
    echo "<script>alert('Task updated successfully!'); window.location.href = 'tasks.php';</script>";
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
