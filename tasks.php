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
        <!-- PHP code to fetch tasks from the database and display them -->
        <?php
        // Implement PHP logic here to fetch tasks from the database and display them
        ?>
        <!-- Sample Task (replace this with PHP code to display tasks) -->
        <div class="task">
            <h3>Task Name</h3>
            <p>Task Details</p>
            <p>Due Date: 2023-12-31</p>
            <p>Priority: High</p>
            <button>Update</button>
            <button>Complete</button>
        </div>
        <!-- End of Sample Task -->
    </div>
</div>

</body>
</html>
