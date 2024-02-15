<?php
require_once('db_config.php');
// Establish a database connection (replace with your database connection code)

// Assuming you have an 'id' parameter in the URL that represents the image record in the database
if (isset($_GET['id'])) {
    $imageId = $_GET['id'];

    // Fetch image data from the database based on the provided id
    $sql = "SELECT data FROM images WHERE id = $imageId";
    $result = mysqli_query($con, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the image data
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Output the image using the data URI scheme
            $imageDataUri = 'data:image/jpeg;base64,' . base64_encode($row['data']);
            echo '<img src="' . $imageDataUri . '" alt="Image" style="height:100px";>';
        } else {
            echo 'Image not found.';
        }

        // Free the result set
        mysqli_free_result($result);
    } else {
        echo 'Error executing SQL query: ' . mysqli_error($yourDatabaseConnection);
    }
} else {
    echo 'Image id not provided.';
}

// Close the database connection
mysqli_close($yourDatabaseConnection);
