<?php
// Backend file for deleting events in the events page

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
    $id = $_POST['event_id']; // Adjust the name according to your form

    // Prepare and execute the SQL DELETE statement
    $stmt = $conn->prepare("DELETE FROM events WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Event deleted successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
