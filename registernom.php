<?php

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kiutso_award";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact_details = mysqli_real_escape_string($conn, $_POST['contact_details']);
    $picture = $_FILES(mysqli_real_escape_string($conn, $_POST['picture']));
    // Insert the data into the database
    $sql = "INSERT INTO nominees (name, email, contact_details, picture)
    VALUES ('$name', '$email', '$contact_details', '$picture')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);

?>
