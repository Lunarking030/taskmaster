<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        /* Basic CSS for login form */
        body {
            font-family: Arial, sans-serif;
            background-color: #ADD8E6; /* Change this color to the desired background color */
            margin: 0;
            padding: 0;
        }
        
        .registration-container {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 5px;
            background-color: #f0f0f0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            margin-bottom: 15px;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        p {
            text-align: center;
            margin-top: 15px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <h2>Welcome to TaskMaster!</h2>
        <form action="login_process.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="registration_form.php">Register here</a></p>
    </div>

    <?php 
        include('footer.php'); // add copyright stuff at the end of the page
    ?>
</body>
</html>
