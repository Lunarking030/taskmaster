<?php

//backend file to use javascript to fetch events data from events table, written by John-Bryan Nicdao


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

// Query to fetch events
$sql = "SELECT id, title, start_date, end_date FROM events"; // Adjust based on your table structure
$result = $conn->query($sql);

// If events are found, format data and return as JSON
if ($result->num_rows > 0) {
    $events = array();
    while ($row = $result->fetch_assoc()) {
        $events[] = $row; // Push each event row into the events array
    }
    
    // Return events data as JSON
    echo json_encode($events);
} else {
    // No events found
    echo json_encode(array()); // Return an empty array as JSON
}

// Close the database connection
$conn->close();
?>
