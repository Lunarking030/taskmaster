<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Settings</title>
    <style>
        /* CSS for Account Settings Page */
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

        /* Form styles */
        .account-form {
            max-width: 400px;
            margin: 0 auto;
        }

        .account-form input[type="text"],
        .account-form input[type="password"],
        .account-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
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
            <a href="#" onclick="this.parentNode.submit(); return false;">Logout</a>
        </form>
    </li>
</ul>

<div class="content">
    <h1>Account Settings</h1>
    <div class="account-form">
        <form action="update_profile.php" method="post">
            <h3>Change Username</h3>
            <input type="text" name="new_username" placeholder="Enter new username" required>
            <input type="submit" value="Change Username">
        </form>
        <form action="update_password.php" method="post">
            <h3>Change Password</h3>
            <input type="password" name="current_password" placeholder="Enter current password" required>
            <input type="password" name="new_password" placeholder="Enter new password" required>
            <input type="submit" value="Change Password">
        </form>
    </div>
</div>

</body>
</html>