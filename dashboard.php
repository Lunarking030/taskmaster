<?php

// dashboard.php = dashboard or home page, written by John-Bryan Nicdao


session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Assume you have the user's name stored in $_SESSION['username']
$userName = $_SESSION['username'];

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
    <h1>Welcome to your Dashboard, <span class="username"><?= $userName ?></span>!</h1>
    <p>This is the home page...</p>
</div>

</body>
</html>
