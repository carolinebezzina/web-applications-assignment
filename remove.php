<!DOCTYPE html>
<html>
	<head>
		<title>Flight Removal - Region Air</title>
		<meta charset="UTF-8">
		<meta name="description" content="administration, regionAir, flights, remove">
		<link rel="stylesheet" href="assign.css" type="text/css" />
	</head>
	<body>
		<?php
			$conn = mysql_connect("localhost", "twa166", "twa166g5");
			mysql_select_db("airline166", $conn)
			or die ('Database not found ' . mysql_error() );
			$flightID = $_GET["flightID"];
			$sql = "SELECT * FROM flights where flightID = '$flightID'";
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
				<h1>Flight Removal</h1>
				<h2>Flight Details</h2>
				<br />
				<form id="remove" action="confirm.php" method="post">
					<table>
						<tr>
							<th>Flight ID</th>
							<th>Flight Date/Time</th>
							<th>Departure Location</th>
							<th>Destination</th>
							<th>No. of Seats</th>
							<th>No. Booked</th>
							<th>Checkin closed?</th>
							<?php
								while ($row = mysql_fetch_array($rs)) { ?>
								<tr>
									<td><?php echo $row["flightID"]?></td>
									<td><?php echo $row["flighttime"]?></td>
									<td><?php echo $row["leaving"]?></td>
									<td><?php echo $row["dest"]?></td>
									<td><?php echo $row["seats"]?></td>
									<td><?php echo $row["booked"]?></td>
									<td><?php echo $row["closed"]?></td>
								</tr>
							<?php } ?>
						</table>
						<input type="hidden" name="flightID" value="<?php echo $flightID ?>" />
						<input type="submit" name="clear" id="clear" value="Clear Flight" />
						</form>
					</div>
				</div>
			</body>
		</html>
		