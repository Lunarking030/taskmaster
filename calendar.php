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
    <title>Full Calendar PHP MySQL Example</title>
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css">

    <style>
        /* CSS for Navbar */
        body {
            margin: 0; /* Set margin to zero to touch the top */
            font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
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
            background-color: #ddd;
            color: black;
        }

        .logout {
            float: right; /* This aligns the logout button to the right */
        }

        #calendar {
            width: 650px;
            margin: 0 auto;
            background-color: #f0f0f0; /* Add this line to set the calendar background to white */
        }
        h2 {
            text-align: center;
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


<br/>
<div id='calendar'></div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<script>
    $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        var calendar = $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: "events.php",
            eventRender: function(event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            
           
        });
    });
</script>

<?php 
// Fetch events from the database and add to FullCalendar
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

$events = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

$conn->close();

// Convert events to JSON and pass them to FullCalendar
echo '<script>';
echo 'var events = ' . json_encode($events) . ';';
echo '$(document).ready(function() {';
echo '$("#calendar").fullCalendar("addEventSource", events);';
echo '});';
echo '</script>';
?>


<?php 
        include('footer.php'); // add copyright stuff at the end of the page
    ?>

</body>
</html>
