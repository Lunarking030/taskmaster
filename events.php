<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events</title>
    <style>
        /* CSS for Events Page */
        body {
            font-family: Arial, sans-serif;
            background-color:  #49a8e9; /* Change this color to the desired background color */
            margin: 0;
            padding: 0;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333; /* Dark background for the navbar */
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #ddd;DS
            color: black;
        }

        .content {
            padding: 20px;
        }

        .logout {
            float: right; /* This aligns the logout button to the right */
        }
        
        /* Event list styles */
        .event-list {
            max-width: 600px;
            margin: 0 auto;
        }

        .event {
            margin-bottom: 10px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        /* Event form styles */
        .event-form {
            max-width: 400px;
            margin: 20px auto;
        }

        .event-form input[type="text"],
        .event-form input[type="date"],
        .event-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            background-color: #f0f0f0;
        }

        /* CSS */
        .no-events {
        text-align: center;
        margin-top: 20px; /* Adjust margin as needed */
        }

    </style>
</head>
<body>

<ul>
    <li><a href="dashboard.php">Home Page</a></li>
    <li><a href="calendar.php">Calendar</a></li>
    <li><a href="tasks.php">Tasks</a></li>
    <li><a href="events.php">Events</a></li>
    <li><a href="account_settings.php">Account Settings</a></li>
    <li class="logout">
        <form action="logout.php" method="post">
            <input type="submit" name="logout" value="Logout" style="display: none;">
            <a href="#" onclick="this.parentNode.submit(); return false;">Logout</a>
        </form>
    </li>
</ul>

<div class="content">
    <h1>Events</h1>

    <!-- Event creation form -->
    <div class="event-form">
        <h3>Create New Event</h3>
        <form action="create_event.php" method="post">
            <input type="text" name="event_title" placeholder="Event Title" required>
            <input type="date" name="start_date" required>
            <input type="date" name="end_date" required>
            <input type="submit" value="Create Event">
        </form>
    </div>

    <!-- Event list -->
    <div class="event-list">
        <!-- PHP code to fetch events from the database and display them -->
        <?php

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
        $sql = "SELECT id, title, start_date AS start, end_date AS end FROM events";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="event">';
                echo '<h3>' . $row['title'] . '</h3>';
                echo '<p>Start Date: ' . $row['start'] . '</p>';
                echo '<p>End Date: ' . $row['end'] . '</p>';
                // Remove the update form for each event
                echo '<form action="delete_event.php" method="post">';
                echo '<input type="hidden" name="event_id" value="' . $row['id'] . '">';
                echo '<button type="submit">Delete</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            // Centered message when no events found
            echo '<div class="no-events"><p>No events found.</p></div>';
        }

        $conn->close();
        ?>
        
    </div>
</div>

<?php 
        include('footer.php'); // add copyright stuff at the end of the page
    ?>

</body>
</html>
