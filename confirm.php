<!DOCTYPE html>
<html>
	<head>
		<title>Flight Removal Confirmation - Region Air</title>
		<meta charset="UTF-8">
		<meta name="description" content="regionAir, flights, remove">
		<link rel="stylesheet" href="assign.css" type="text/css" />
	</head>
	<body>
		<?php
			$conn = mysql_connect("localhost", "twa166", "twa166g5");
			mysql_select_db("airline166", $conn)
			or die ('Database not found ' . mysql_error() );
			$flightID = $_POST["flightID"];
			$tableID = str_replace('.', '_', $flightID);
		?>
		<div id="wrapper">
			<div id="header">
				<div id ="login">
					<ul>
						<li><a href="logout.php">Logout</a></li>
						<li><a href="adminlogin.php">Administrator Login</a></li>
						<li><a href="fflogin.php">Frequent Flyer Login</a></li>
					</ul>
				</div>
				<div id="logo">
					<img src="logo.jpg" alt="RegionAir's Logo">
				</div>
				<div id ="nav">
					<ul>
						<li><a href="home.html">Home</a></li>
						<li><a href="rego.php">Passenger Registration</a></li>
						<li><a href="terms.html">Terms & Conditions</a></li>
					</ul>
				</div>
				</div>
				<div id="body">
					<h1>Flight Removal Confirmation</h1>
					<?php

						$sql = "DELETE FROM booking WHERE flightID = '$flightID'";
						$sql2 = "DELETE FROM $tableID";
						if (mysql_query($sql, $conn) && (mysql_query($sql2, $conn)))
						{
							echo "Flight has been successfully deleted.";
						}
						else
						{
							echo "An error has occurred. Please try again.";
						}



					?>
					</div>
					</div>
					</body>
					</html>