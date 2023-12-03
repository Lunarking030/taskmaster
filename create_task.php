<?php

//backend for creating tasks in task page, written by John-Bryan Nicdao


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

// Check if form data is received and process task creation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare the INSERT query using a prepared statement
    $insertQuery = "INSERT INTO tasks (task_name, task_details, due_date, priority) 
                    VALUES (?, ?, ?, ?)";
    
    // Get form data
    $taskName = $_POST['task_name'];
    $taskDetails = $_POST['task_details'];
    $dueDate = $_POST['due_date'];
    $priority = $_POST['priority'];

    // Create a prepared statement
    $stmt = mysqli_prepare($mysqli, $insertQuery);

    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "ssss", $taskName, $taskDetails, $dueDate, $priority);

    // Execute the prepared statement
    $result = mysqli_stmt_execute($stmt);

  // Check if the query was successful
if ($result) {
    // Task created successfully, triggers a JavaScript alert
    echo "<script>alert('Task created successfully!'); window.location.href = 'tasks.php';</script>";
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

