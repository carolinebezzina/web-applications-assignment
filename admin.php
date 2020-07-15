<!DOCTYPE html>
<html>
	<head>
		<title>Administration - Region Air</title>
		<meta charset="UTF-8">
		<meta name="description" content="administration, regionAir, flights, assign, seats, remove">
		<link rel="stylesheet" href="assign.css" type="text/css" />
	</head>
	<body>
		<?php
			$conn = mysql_connect("localhost", "twa166", "twa166g5");
			mysql_select_db("airline166", $conn)
			or die ('Database not found ' . mysql_error() );
			$sql = "SELECT flightID, flighttime, leaving, dest FROM flights";
			$rs = mysql_query($sql, $conn)
			or die ('Problem with query' . mysql_error());
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
				<h1>Administration</h1>
				<h2>Available Flights</h2>
				<br />
				<table>
					<tr><th>From</th><th>To</th><th>Date/Time</th><th>Assign Seats</th><th>Remove</th></tr>
					<?php
						while ($row = mysql_fetch_array($rs)) { ?>
						<tr>
							<td><?php echo $row["leaving"]?></td><td><?php echo $row["dest"]?></td><td><?php echo $row[
								"flighttime"]?></td><td><a href="assign.php?flightID=<?php echo $row["flightID"]?>">Assign Seats
							</a></td><td><a href="remove.php?flightID=<?php echo $row["flightID"]?>">Remove</a></td>
						</tr>
					<?php } ?>
				</table>
				
			</div>
		</div>
		<?php mysql_close($conn); ?>
	</body>
</html>