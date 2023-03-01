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
    $regnumber = mysqli_real_escape_string($conn,$_POST['regnumber']);
    $contact_details = mysqli_real_escape_string($conn, $_POST['contact_details']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $categories = mysqli_real_escape_string($conn, $_POST['categories']);

    // Handle picture upload
    $picture = "";
    if (isset($_FILES['picture'])) {
        $picture_file = $_FILES['picture'];
        $picture_path = $picture_file['tmp_name'];
        $picture_type = $picture_file['type'];
        if ($picture_type === 'image/jpeg' || $picture_type === 'image/png') {
            $picture_data = file_get_contents($picture_path);
            $picture = mysqli_real_escape_string($conn, $picture_data);
        }
    }
    // Insert the data into the database
    $sql = "INSERT INTO nominees (name,regnumber,  contact_details, email, picture,link,categories) 
     VALUES ('$name','$regnumber','$contact_details','$email','$picture','$link','$categories')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);

?>
