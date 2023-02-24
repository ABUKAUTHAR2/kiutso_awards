<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
   
    .card-client {
  background: #4CAF50;
  width: 15rem;
  padding-top: 25px;
  padding-bottom: 25px;
  padding-left: 20px;
  padding-right: 20px;
  border: 4px solid #7cdacc;
  box-shadow: 0 6px 10px rgba(207, 212, 222, 1);
  border-radius: 10px;
  text-align: center;
  color: #fff;
  font-family: "Poppins", sans-serif;
  transition: all 0.3s ease;
  margin-left: 5%;
  padding-top:3%;

  
}

.card-client:hover {
  transform: translateY(-10px);
}

.user-picture {
  overflow: hidden;
  object-fit: cover;
  width: 5rem;
  height: 5rem;
  border: 4px solid #7cdacc;
  border-radius: 999px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: auto;
}

.user-picture svg {
  width: 2.5rem;
  fill: currentColor;
}

.name-client {
  margin: 0;
  margin-top: 20px;
  font-weight: 600;
  font-size: 18px;
}

.name-client span {
  display: block;
  font-weight: 200;
  font-size: 16px;
}

.social-media:before {
  content: " ";
  display: block;
  width: 100%;
  height: 2px;
  margin: 20px 0;
  background: #7cdacc;
}





button {
 font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
 font-size: 17px;
 padding: 1em 2.7em;
 font-weight: 500;
 background: #1F2937;
 color: white;
 border: none;
 position: relative;
 overflow: hidden;
 border-radius: 0.6em;
}

.gradient {
 position: absolute;
 width: 100%;
 height: 100%;
 left: 0;
 top: 0;
 border-radius: 0.6em;
 margin-top: -0.25em;
 background-image: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.3));
}

.label {
 position: relative;
 top: -1px;
}

.transition {
 transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
 transition-duration: 500ms;
 background-color: #4CAF50;
 border-radius: 9999px;
 width: 0;
 height: 0;
 position: absolute;
 left: 50%;
 top: 50%;
 transform: translate(-50%, -50%);
}

button:hover .transition {
 width: 14em;
 height: 14em;
}

button:active {
 transform: scale(0.97);
}

.nominee-image {
        width: 100%;
      }
      
     
body{
    display: flex;
    flex-direction: row;
    background-image: linear-gradient(135deg, #4CAF50 0%, #ffffff 100%);
    flex-wrap: wrap;
    flex-basis: calc(100% / 2);
     
}

@media (max-width: 767px) {
  body {
    display: flex;
    flex-direction: column;
    
  }
  .card-client {
  background: #4CAF50;
  width: 10rem; 
  margin-left: 15%;
  margin-top:5%;
}
}
  </style>
</head>
<body>

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

  // Check if the 'id' variable is set in the URL
  if (isset($_GET['id'])) {
    // Retrieve the 'id' from the URL
    $id = $_GET['id'];

    // Update the vote count for the selected nominee
    $sql = "UPDATE nominees SET votes = votes + 1 WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if (!$result) {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

  // Retrieve the data from the database
  $sql = "SELECT * FROM nominees";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_array($result)) {

     echo ' <div class="card-client">';
         echo '   <div class="user-picture">';
             echo '<img class="nominee-image" src="data:image/jpeg;base64,'.base64_encode($row['picture']).'"/>'; 
         echo '</div>';
         echo '<p class="name-client">' .$row['name']. '<span>'.$row['votes'].' votes </span></p>';
         echo '<div class="social-media">';
                echo'<button>';
                echo '<span class="transition"></span>';
                echo '<span class="gradient"></span>';
                echo '<span class="label">vote</span>';
                echo '</button>';
          echo '</div>';
          echo '<br>';
          echo'<div>BEST LEADER</div>';
   echo '</div>';
 
  }
    // Close the connection
    mysqli_close($conn);
    ?>
</body>
</html>