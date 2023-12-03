<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Logout handling
if (isset($_POST['logout'])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: logout.php"); // Redirect to logout script
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <style>
        /* CSS for Home Page */
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

        /* Styling for the logout button */
        .logout {
            float: right;
            margin-right: 20px;
        }

        .logout a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .logout a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
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
        <form action="" method="post">
            <input type="submit" name="logout" value="Logout" style="display: none;">
            <a href="#" onclick="this.previousElementSibling.click(); return false;">Logout</a>
        </form>
    </li>
</ul>

<div class="content">
    <h1>Welcome to your Dashboard, <span class="username"><?= $_SESSION['username'] ?></span>!</h1>

    <!-- Latest Tasks Container -->
    <div class="container" id="latestTasksContainer">
        <h2>Latest Tasks</h2>
        <div id="tasksContent"></div>
    </div>

    <!-- Latest Events Container -->
    <div class="container" id="latestEventsContainer">
        <h2>Latest Events</h2>
        <div id="eventsContent"></div>
    </div>

    <script>
    // Function to fetch and display tasks
    function fetchAndDisplayTasks() {
        fetch('fetch_tasks.php')
            .then(response => response.json())
            .then(tasks => {
                const tasksContent = document.getElementById('tasksContent');
                if (tasks.length > 0) {
                    tasks.forEach(task => {
                        const taskDiv = document.createElement('div');
                        taskDiv.classList.add('task');
                        taskDiv.innerHTML = `
                            <h3>${task.task_name}</h3>
                            <p>Details: ${task.task_details}</p>
                            <p>Due Date: ${task.due_date}</p>
                            <p>Priority: ${task.priority}</p>
                            <p>Completion Status: ${task.completion_status}</p>
                        `;
                        tasksContent.appendChild(taskDiv);
                    });
                } else {
                    tasksContent.innerHTML = '<p>No tasks found.</p>';
                }
            })
            .catch(error => console.error('Error fetching tasks:', error));
    }

    // Function to fetch and display events
    function fetchAndDisplayEvents() {
        fetch('fetch_events.php')
            .then(response => response.json())
            .then(events => {
                const eventsContent = document.getElementById('eventsContent');
                if (events.length > 0) {
                    events.forEach(event => {
                        const eventDiv = document.createElement('div');
                        eventDiv.classList.add('event');
                        eventDiv.innerHTML = `
                            <h3>${event.title}</h3>
                            <p>Start Date: ${event.start_date}</p>
                            <p>End Date: ${event.end_date}</p>
                        `;
                        eventsContent.appendChild(eventDiv);
                    });
                } else {
                    eventsContent.innerHTML = '<p>No events found.</p>';
                }
            })
            .catch(error => console.error('Error fetching events:', error));
    }

    // Call the functions to fetch and display tasks and events
    fetchAndDisplayTasks();
    fetchAndDisplayEvents();
</script>
</div>


</body>
</html>
