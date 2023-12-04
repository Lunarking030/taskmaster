<?php
session_start(); // Start the session if not already started

$target_dir = "uploads/profiles";
$target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file is an actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    $uploadOk = 0;
}

// Check file size (adjust the size limit if needed)
if ($_FILES["profile_picture"]["size"] > 500000) {
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    $uploadOk = 0;
}

// After successfully moving the uploaded image to the directory
if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
    // Store the uploaded image path in session
    $_SESSION['profile_picture'] = $target_file; // Update the session variable
    header("Location: account_settings.php?upload_success=true");
    exit();
} else {
    header("Location: account_settings.php?upload_error=true");
    exit();
}

?>
