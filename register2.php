<?php
session_start();

$myserver = "localhost";
$myuserid = "root";
$mypassword = NULL;
$mydatabase = "taskmaster";

$mysqli = mysqli_connect($myserver, $myuserid, $mypassword, $mydatabase)
    or die('Could not connect to MySQLI server!' . mysqli_connect_error());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if username already exists
    $check_query = "SELECT * FROM users WHERE username = ?";
    $check_stmt = $mysqli->prepare($check_query);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "Username already exists";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $insert_query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $insert_stmt = $mysqli->prepare($insert_query);
    $insert_stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($insert_stmt->execute()) {
        $_SESSION['registration_success'] = true;
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $insert_stmt->error;
    }

    $insert_stmt->close();
    $check_stmt->close();
}

$mysqli->close();
?>
