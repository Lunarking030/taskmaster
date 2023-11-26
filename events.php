<?php

//backend file for creating events in the calendar page, written by John-Bryan Nicdao

// Connect to your MySQL database
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

// Fetch events from your database table (adjust table and column names accordingly)
$sql = "SELECT id, title, start_date AS start, end_date AS end FROM events_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Store events in an array
    $events = array();
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    
    // Output events in JSON format
    echo json_encode($events);
} else {
    echo json_encode([]); // If no events found, return an empty array
}

$conn->close();
?>
