<?php
require_once('db_config.php');

function storeImageAsBlob($fileInputName, $databaseConnection) {
    // Check if the file was uploaded without errors
    // var_dump($_FILES['image']);
    // die();
    if ($_FILES[$fileInputName]['error'] == UPLOAD_ERR_OK) {
        // Get additional file information
        $filename = $_FILES[$fileInputName]['name'];
        $type = $_FILES[$fileInputName]['type'];
        $fileSize = $_FILES[$fileInputName]['size'];
        list($fileWidth, $fileHeight) = getimagesize($_FILES[$fileInputName]['tmp_name']);

        // Open the file for reading as binary
        $fileData = file_get_contents($_FILES[$fileInputName]['tmp_name']);

        // Escape the binary data to prevent SQL injection
        $escapedData = mysqli_real_escape_string($databaseConnection, $fileData);

        // Build the SQL query
        $sql = "INSERT INTO images (filename, type, file_size, file_width, file_height, data) VALUES (
            '{$filename}',
            '{$type}',
            '{$fileSize}',
            '{$fileWidth}',
            '{$fileHeight}',
            '{$escapedData}'
        )";

        // Execute the query
        if (mysqli_query($databaseConnection, $sql)) {
            echo 'Image stored successfully in the database.';
        } else {
            echo 'Error storing image in the database: ' . mysqli_error($databaseConnection);
        }
    } else {
        // File upload error
        echo 'File upload error: ' . $_FILES[$fileInputName]['error'];
    }
}

// Example usage (assuming you have a database connection already established)
$fileInputName = 'uploadedImage';  // Change this to match your HTML form's file input name
storeImageAsBlob('image', $con);

?>
