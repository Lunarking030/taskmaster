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

        #calendar {
            width: 650px;
            margin: 0 auto;
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
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'add_events.php',
                        data: 'title='+ title+'&start='+ start +'&end='+ end,
                        type: "POST",
                        success: function(json) {
                            alert('Added Successfully');
                        }
                    });
                    calendar.fullCalendar('renderEvent',
                    {
                        title: title,
                        start: start,
                        end: end,
                        allDay: allDay
                    },
                    true
                    );
                }
                calendar.fullCalendar('unselect');
            },
            editable: true,
            eventDrop: function(event, delta) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                $.ajax({
                    url: 'update_events.php',
                    data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
                    type: "POST",
                    success: function(json) {
                        alert("Updated Successfully");
                    }
                });
            },
            eventClick: function(event) {
                var decision = confirm("Do you really want to do that?");
                if (decision) {
                    $.ajax({
                        type: "POST",
                        url: "delete_event.php",
                        data: "&id=" + event.id,
                        success: function(json) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            alert("Updated Successfully");
                        }
                    });
                }
            },
            eventResize: function(event) {
                var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
                $.ajax({
                    url: 'update_events.php',
                    data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
                    type: "POST",
                    success: function(json) {
                        alert("Updated Successfully");
                    }
                });
            }
        });
    });
</script>

</body>
</html>
