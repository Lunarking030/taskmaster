<?php

//backend file for uploading images for the user's profile picture, written by John-Bryan Nicdao

// This function performs the upload of the profile picture
function upload($input, $dir, $file, $extns, $maxsize) {
    $msg = NULL;
    $rc = 0;

    if (isset($_FILES[$input]['tmp_name'])) {
        if (is_uploaded_file($_FILES[$input]['tmp_name'])) {
            $fn = $_FILES[$input]['name'];
            $ext = trim(strtolower(strrchr($fn, '.')));

            if (!in_array($ext, $extns)) {
                $msg = "Invalid File Type";
                $rc = 10;
            }

            if ($_FILES[$input]['size'] > $maxsize) {
                $msg = "Uploaded file size [" . $_FILES[$input]['size'] . "] exceeds limit [$maxsize]";
                $rc = 11;
            }

            if (substr($dir, -1, 1) != '/') {
                $dir .= '/';
            }

            if (!is_dir($dir)) {
                $msg = "Invalid Directory [$dir]";
                $rc = 13;
            }

            if ($rc == 0) {
                // Generating a unique file name using timestamp to avoid overwriting existing files
                $timestamp = time();
                $savefile = $dir . strtolower($file) . '_' . $timestamp . $ext;

                $result = move_uploaded_file($_FILES[$input]['tmp_name'], $savefile);
                if (!$result) {
                    $msg = "Move Uploaded File Failed";
                    $rc = 1; // Update this value based on your error handling
                } else {
                    // File successfully uploaded, return the path
                    return array($rc, $savefile);
                }
            }
        } else {
            $msg = "No Uploaded File";
            $rc = 12;
        }
    } else {
        $msg = "No Uploaded File";
        $rc = 12;
    }

    return array($rc, $msg);
}

// Usage example:
$inputName = 'profile_picture'; // Input name attribute in the HTML form
$uploadDir = 'uploads/profiles/'; // Directory where profile pictures will be saved
$fileName = 'profile_image'; // Desired file name (without extension)
$allowedExtensions = ['.png', '.jpg', '.jpeg', '.gif']; // Allowed file extensions
$maxFileSize = 5 * 1024 * 1024; // Maximum file size in bytes (here, 5MB)

// Perform the upload
list($status, $message) = upload($inputName, $uploadDir, $fileName, $allowedExtensions, $maxFileSize);

if ($status == 0) {
    echo "File uploaded successfully: $message";
} else {
    echo "Upload failed: $message";
}
?>
