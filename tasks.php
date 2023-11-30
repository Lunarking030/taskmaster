<?php

// Frontend file for displaying the tasks page, written by John-Bryan Nicdao

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

// Fetch tasks from the database
$query = "SELECT * FROM tasks"; // Modify the query according to your table structure
$result = mysqli_query($mysqli, $query);

// Check if query execution was successful
if (!$result) {
    die("Error: " . mysqli_error($mysqli));
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tasks</title>
    <style>
        /* CSS for Tasks Page */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
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
            background-color: #ddd;
            color: black;
        }

        .content {
            padding: 20px;
        }

        /* Task list styles */
        .task-list {
            max-width: 600px;
            margin: 0 auto;
        }

        .task {
            margin-bottom: 10px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        /* Task form styles */
        .task-form {
            max-width: 400px;
            margin: 20px auto;
        }

        .task-form input[type="text"],
        .task-form input[type="date"],
        .task-form select,
        .task-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
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
    <h1>Tasks</h1>

    <!-- Task creation form -->
    <div class="task-form">
        <h3>Create New Task</h3>
        <form action="create_task.php" method="post">
            <input type="text" name="task_name" placeholder="Task Name" required>
            <textarea name="task_details" placeholder="Task Details" rows="4" required></textarea>
            <input type="date" name="due_date" required>
            <select name="priority" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
            <input type="submit" value="Create Task">
        </form>
    </div>

    <!-- Task list -->
    <div class="task-list">
        
        <?php 
        while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="task">
        <h3><?php echo $row['task_name']; ?></h3>
        <p><?php echo $row['task_details']; ?></p>
        <p>Due Date: <?php echo $row['due_date']; ?></p>
        <p>Priority: <?php echo $row['priority']; ?></p>
        
        <form action="update_task.php" method="post">
            <input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">
            <button type="submit">Update</button>
        </form>
    
        <form action="complete_task.php" method="post">
            <input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">
            <button type="submit">Complete</button>
        </form>
    
        <form action="delete_task.php" method="post">
            <input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">
            <button type="submit">Delete</button>
        </form>
    </div>
<?php } 

        // Free the result set
        mysqli_free_result($result);

        // Close the database connection
        mysqli_close($mysqli);
        ?>
    </div>
</div>

</body>
</html>
