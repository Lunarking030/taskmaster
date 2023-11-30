<?php

// Database connection
$myserver = "localhost";
$myuserid = "root"; // Replace with your MySQL username
$mypassword = NULL; // Replace with your MySQL password
$mydatabase = "taskmaster"; // Replace with your database name

$mysqli = mysqli_connect($myserver, $myuserid, $mypassword, $mydatabase);

// Check connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];

    // Perform deletion query
    $query = "DELETE FROM tasks WHERE id = $task_id"; // Modify according to your table structure
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        // Task deleted successfully
        header("Location: tasks.php"); // Redirect back to tasks page after deletion
        exit();
    } else {
        // Error in deletion
        echo "Error: " . mysqli_error($mysqli);
    }
}
?>
