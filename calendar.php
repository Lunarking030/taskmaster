<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Calendar with FullCalendar</title>
    <!-- FullCalendar CSS -->
    <link href='node_modules/fullcalendar/main.css' rel='stylesheet' />
</head>
<body>
    <div id='calendar'></div>

    <!-- jQuery -->
    <script src='node_modules/jquery/dist/jquery.min.js'></script>
    <!-- FullCalendar JavaScript -->
    <script src='node_modules/fullcalendar/main.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                // Your FullCalendar configuration options here
                // For example:
                initialView: 'dayGridMonth',
                // Add more options as needed
                events: {
                    url: 'events.php', // PHP script to fetch events from your database
                    method: 'POST', // Use POST method to fetch events
                    extraParams: {
                        // Any extra parameters you want to send to events.php
                    }
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>
