<?php
// Backend file for updating events in the events page

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
    $title = $_POST['event_title']; // Adjust the name according to your form
    $start_date = $_POST['start_date']; // Adjust the name according to your form
    $end_date = $_POST['end_date']; // Adjust the name according to your form

    // Prepare and execute the SQL UPDATE statement
    $stmt = $conn->prepare("UPDATE events SET title=?, start_date=?, end_date=? WHERE id=?");
    $stmt->bind_param("sssi", $title, $start_date, $end_date, $id);

    if ($stmt->execute()) {
        echo "Event updated successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
