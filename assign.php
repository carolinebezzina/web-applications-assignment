<!DOCTYPE html>
<html>
	<head>
		<title>Assignment - Region Air</title>
		<meta charset="UTF-8">
		<meta name="description" content="administration, regionAir, flights, assign, seats">
		<link rel="stylesheet" href="assign.css" type="text/css" />
	</head>
	<body>
		<?php
			session_start();
			$conn = mysql_connect("localhost", "twa166", "twa166g5");
			mysql_select_db("airline166", $conn)
			or die ('Database not found ' . mysql_error() );
			if (!isset($_POST["assign"]) && !isset($_POST["close"]))
			{
				$flightID = $_GET["flightID"];
				$_SESSION["flightID"] = $flightID;
			}
			else if (isset($_POST["assign"]) || isset($_POST["close"]))
			{
				$flightID = $_SESSION["flightID"];
			}
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
				<h1>Assignment</h1>
				<br />
				<form id="assignment" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<table>
						<tr><td>Passenger Name: </td><td>
							<select name="passenger" id="passenger" size="1">
								<option value="select" disabled selected>--Select--</option>
								<?php
									$sql = "SELECT ref, gname, fname FROM booking WHERE flightID = '$flightID'";
									$rs = mysql_query($sql, $conn)
									or die ('Problem with query' . mysql_error());
									while ($row = mysql_fetch_array($rs))
									{
										$ref = $row["ref"];
										$reference = "SELECT booking FROM $tableID WHERE booking = '$ref'";
										$count = mysql_query($reference, $conn);
										$num = mysql_num_rows($count);
										if ($num == 0)
										{
											?><option value="<?php echo $row["ref"]?>"><?php echo $row["gname"], " ", $row["fname"]?></option><?php
										}
									} ?>
							</select></td></tr>
							<tr><td>Seat: </td><td>
								<select name="seat" id="seat" size="1">
									<option value="select" disabled selected>--Select--</option>
									<?php
										$sql2 = "SELECT seats FROM flights WHERE flightID = '$flightID'";
										$rs2 = mysql_query($sql2, $conn)
										or die ('Problem with query' . mysql_error());
										while ($row = mysql_fetch_array($rs2))
										{
											$seats = $row["seats"];
											for ($i = 1; $i <= ($seats / 4); $i++)
											{
												$A = 'A';
												$iA = ($i . $A);
												$countseatA = "SELECT seat FROM $tableID WHERE seat = '$iA'";
												echo $countseatA;
												$countA = mysql_query($countseatA, $conn);
												$numA = mysql_num_rows($countA);
												echo $numA;
												if ($numA == 0)
												{
													?><option value="<?php echo $i ?>A"><?php echo $i ?>A</option><?php
												}
												$C = 'C';
												$iC = ($i . $C);
												$countseatC = "SELECT seat FROM $tableID WHERE seat = '$iC'";
												$countC = mysql_query($countseatC, $conn);
												$numC = mysql_num_rows($countC);
												if ($numC == 0)
												{
												?><option value="<?php echo $i ?>C"><?php echo $i ?>C</option><?php
												}
												$D = 'D';
												$iD = ($i . $D);
												$countseatD = "SELECT seat FROM $tableID WHERE seat = '$iD'";
												$countD = mysql_query($countseatD, $conn);
												$numD = mysql_num_rows($countD);
												if ($numD == 0)
												{
													?><option value="<?php echo $i ?>D"><?php echo $i ?>D</option><?php
												}
												$F = 'F';
												$iF = ($i . $F);
												$countseatF = "SELECT seat FROM $tableID WHERE seat = '$iF'";
												$countF = mysql_query($countseatF, $conn);
												$numF = mysql_num_rows($countF);
												if ($numF == 0)
												{
													?><option value="<?php echo $i ?>F"><?php echo $i ?>F</option><?php
												}
											}
										} ?>
								</select></td></tr>
								<tr><td><input type="submit" name="assign" value="Assign Passenger" /></td>
								<td><input type="submit" name="close" value="Close Flight" /></td></tr>
					</table>
				</form>
				<?php
					
					if (isset($_POST["assign"]))
					{
						$ref = $_POST["passenger"];
						$seat = $_POST["seat"];
						$countsql = "SELECT passenger FROM $tableID";
						if ($result = mysql_query($countsql, $conn))
						{
							$pID = (mysql_num_rows($result) + 1);
						}
						$checkin = "INSERT INTO $tableID (passenger, booking, seat) VALUES ('$pID', '$ref', '$seat')";
						if (mysql_query($checkin))
						{
							echo "<br />Successfully assigned!";
						}
						else
						{
							echo mysql_error();
						}
						
					}
					else if (isset($_POST["close"]))
					{
						$closeflight = "True";
						$sql = "SELECT ref, gname, fname FROM booking WHERE flightID = '$flightID'";
						$rs = mysql_query($sql, $conn)
						or die ('Problem with query' . mysql_error());
						while ($row = mysql_fetch_array($rs))
						{
							$ref = $row["ref"];
							$reference = "SELECT booking FROM $tableID WHERE booking = '$ref'";
							$count = mysql_query($reference, $conn);
							$num = mysql_num_rows($count);
							if ($num == 0)
							{
								$closeflight = "False";
							}
						}
						if ($closeflight == "False")
						{
							echo "<br /><span class='required'>Please assign all remaining passengers before closing the flight.</span>";
						}
						else
						{
							$updateflight = "UPDATE flights SET closed='y' WHERE flightID='$flightID'";
							echo "<br />Flight successfully closed.";
						}
					}
				?>
			</div>
		</div>
		<?php mysql_close($conn); ?>
	</body>
</html>