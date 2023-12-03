<?php

//backend to use javascript to fetch data from tasks table, written by John-Bryan Nicdao

// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = NULL;
$dbname = "taskmaster";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch tasks
$sql = "SELECT id, task_name, task_details, due_date, priority, completion_status FROM tasks"; 
$result = $conn->query($sql);

// If tasks are found, format data and return as JSON
if ($result->num_rows > 0) {
    $tasks = array();
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row; // Push each task row into the tasks array
    }
    
    // Return tasks data as JSON
    echo json_encode($tasks);
} else {
    // No tasks found
    echo json_encode(array()); // Return an empty array as JSON
}

// Close the database connection
$conn->close();
?>
