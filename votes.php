<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>KIUTSO Awards</title>
	<link rel="stylesheet" href="votes.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="script.js"></script>
</head>
<body>
	<header>
		<img src="logo.png" alt="KIUTSO Logo">
		<h1>KIUTSO Awards</h1>
	</header>

	<main>
		<?php
		// connect to database
		$host = "localhost";
		$username = "username";
		$password = "password";
		$dbname = "database_name";
		$conn = mysqli_connect($host, $username, $password, $dbname);

		// check for connection errors
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		// get list of nominees
		$sql = "SELECT * FROM nominees";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			echo "<div class='nominees'>";
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<div class='nominee'>";
				echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
				echo "<div class='nominee-info'>";
				echo "<h2>" . $row['name'] . "</h2>";
				echo "<p>" . $row['category'] . "</p>";
				echo "<button class='vote-button' data-id='" . $row['id'] . "'>Vote</button>";
				echo "</div>"; // nominee-info
				echo "</div>"; // nominee
			}
			echo "</div>"; // nominees
		}

		// close database connection
		mysqli_close($conn);
		?>
	</main>
</body>
</html>
