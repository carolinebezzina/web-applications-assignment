<!DOCTYPE html>
<html>
	<head>
		<title>Check-In - Region Air</title>
		<meta charset="UTF-8">
		<meta name="description" content="regionAir, flights, passenger, checkin">
		<link rel="stylesheet" href="assign.css" type="text/css" />
		<script type="text/JavaScript">
			<!--
			function requiredField(obj)
			{
				var i = eval(obj.value);
				if (i == null || i == "")
				{
					alert("Please complete this field.");
					return;
				}
			}
			function validateForm()
			{
				var bookingref = document.getElementById("bookingref").value;
				
				if (bookingref != "")
				{
					return true;
				}
				else
				{
					alert("Please complete this field.");
					return false;
				}
			}
			
			function validateForm2()
			{
				
				if (document.getElementById('correct').checked && document.getElementById('dangerous').checked)
				{
					return true;
				}
				else
				{
					alert("Please check both items before continuing.");
					return false;
				}
			}
			-->
		</script>
	</head>
	<body>
		<?php
			$conn = mysql_connect("localhost", "twa166", "twa166g5");
			mysql_select_db("airline166", $conn)
			or die ('Database not found ' . mysql_error() );
			session_start();
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
				<h1>Check-in</h1>
				<form id="checkin1" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" onsubmit="return
				validateForm()">
					<table>
						<tr><td>Please enter your Booking Reference: </td><td><input type="text"
						name="bookingref" id="bookingref" onblur="requiredField(this);" /></td></tr>
						<tr><td><input type="submit" name="submit" value="Submit" onclick = "return validateForm()" />
						</td><td></td></tr>
					</table>
				</form>
				<?php
					if (isset($_POST["submit"]))
					{
						$bookingref = $_POST["bookingref"];
						$sql = "SELECT flights.flightID, ref, fname, gname, flighttime, leaving, dest  FROM booking, flights WHERE ref = '$bookingref' AND booking.flightID = flights.flightID";
						$rs = mysql_query($sql, $conn);
						if (mysql_num_rows($rs)>0)
						{
						?>
						<h2>Your Booking Details</h2>
						<br />
						<table>
							<tr><th>Last Name</th><th>First Name</th><th>Flight Date/Time</th><th>Flight Route</th></tr>
							<?php
								while ($row = mysql_fetch_array($rs))
								{
									$_SESSION["ref"] = $row["ref"];
									$ref = $_SESSION["ref"];
									$fname = $row["fname"];
									$gname = $row["gname"];
									$flighttime = $row["flighttime"];
									$leaving = $row["leaving"];
									$dest = $row["dest"];
									$_SESSION["flightID"] = $row["flightID"];
									
									echo "<tr><td>$fname</td><td>$gname</td><td>$flighttime</td><td>$leaving to $dest</td></tr>";
								}
							?>
						</table>
						<br />
						<form id="checkin2" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" onsubmit="return
						validateForm2()">
							<p>The above passenger details are correct.<input type="checkbox" name="correct" id="correct"></p>
							<br />
							<p>I will not be carrying any dangerous items.<input type="checkbox" name="dangerous" id="dangerous"></p>
							<br />
							<input type="submit" name="submit2" value="Submit" onclick = "return validateForm2()" />
						</form>
						<?php
						}
						else
						{
							echo "<br /><p><span class='required'>Booking reference not found. Please try again.</span></p>";
						}
					}
					if (isset ($_POST["submit2"]))
					{
						$flightID = $_SESSION["flightID"];
						$tableID = str_replace('.', '_', $flightID);
						$ref = $_SESSION["ref"];
						$countsql = "SELECT passenger FROM $tableID";
						if ($result = mysql_query($countsql, $conn))
						{
							$pID = (mysql_num_rows($result) + 1);
						}
						$checkin = "INSERT INTO $tableID (passenger, booking, seat) VALUES ('$pID', '$ref', ' ')";
						if(mysql_query($checkin, $conn))
						{
							echo "<br />Check-in successful!";
						}
						else
						{
							echo mysql_error();
						}
					}
				mysql_close($conn); ?>
				</div>
			</div>
		</body>
	</html>	