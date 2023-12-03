<?php
// Backend file for creating events in the events page

// Add your MySQL connection details
$servername = "localhost";
$username = "root";
$password = NULL;
$dbname = "taskmaster";

// Establish a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['event_title']; 
    $start_date = $_POST['start_date']; 
    $end_date = $_POST['end_date']; 

    // Prepare and execute the SQL INSERT statement
    $stmt = $conn->prepare("INSERT INTO events (title, start_date, end_date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $start_date, $end_date);

    if ($stmt->execute()) {
        // Event created successfully
        echo "<script>alert('Event created successfully');</script>";
        // Redirect back to events page after creation
        echo "<script>window.location.href = 'events.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
