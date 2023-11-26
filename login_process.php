<?php
session_start();

$myserver = "localhost";
$myuserid = "root";
$mypassword = NULL;
$mydatabase = "taskmaster";

// Establish connection to the database
$mysqli = mysqli_connect($myserver, $myuserid, $mypassword, $mydatabase)
    or die('Could not connect to MySQLI server!' . mysqli_connect_error());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user details from the database
    $query = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Valid login, set session variables and redirect to masterboard.php
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Invalid username";
    }

    $stmt->close();
}

$mysqli->close();
?>
