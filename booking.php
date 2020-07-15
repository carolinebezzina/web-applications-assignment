<!DOCTYPE html>
<html>
	<head>
		<title>Booking - Region Air</title>
		<meta charset="UTF-8">
		<meta name="description" content="booking, regionAir, flights">
		<link rel="stylesheet" href="assign.css" type="text/css" />
		<script type="text/JavaScript">
			<!--
			function requiredField(obj)
			{
				var i = eval(obj.value);
				if (i == null || i == "")
				{
					alert("Please complete this field");
					return;
				}
			}
			
			function validateForm()
			{
				var ccname = document.getElementById("ccname").value;
				var cctype = document.getElementById("cctype").value;
				var ccnumber = document.getElementById("ccnumber").value;
				var expiry = document.getElementById("expiry").value;
				var verify = document.getElementById("verify").value;
				
				if (ccname != "" && cctype != "select" && ccnumber != "" && expiry != "" && verify != "")
				{
					return true;
				}
				else
				{
					alert("Please complete the required fields marked with an asterisk (*).");
					return false;
				}
			}
			-->
		</script>
	</head>
	<body>
		<?php
			session_start();
			$conn = mysql_connect("localhost", "twa166", "twa166g5");
			mysql_select_db("airline166", $conn)
			or die ('Database not found ' . mysql_error() );
			
			function payFlight(){
			?>
			<form id="booking5" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post"
			onsubmit="return validateForm()">
				<table>
					<tr><td>Name on Credit Card: <span class = "required">*</span> </td><td><input type="text"
					name="ccname" id="ccname" size ="30" onblur="requiredField(this);" /></td></tr>
					<tr><td>Type of Credit Card: <span class = "required">*</span> </td><td><select name="cctype"
						id="cctype" size="1">
							<option value="select" disabled selected>--Select--</option>
							<option value="visa">Visa</option>
							<option value="mc">MC</option>
						<option value="amex">Amex</option></select></td></tr>
						<tr><td>Credit Card Number: <span class = "required">*</span> </td><td><input type="text"
						name="ccnumber" id="ccnumber" size="30" onblur="requiredField(this);" /></td></tr>
						<tr><td>Expiry Date: (mm/yy) <span class = "required">*</span> </td><td><input type="text"
						name="expiry" id="expiry" size="6" onblur="requiredField(this);" /></td></tr>
						<tr><td>Verification Code: <span class = "required">*</span> </td><td><input type="text"
						name="verify" id="verify" size="4" onblur="requiredField(this);" /></td></tr>
				</tr></table>
				<p><span class="required">* Required Fields</span></p>
				<table><tr><td><input type="submit" name="submit6" id="submit" value="Submit"
				/></td><td><input type="reset" name="reset" id="reset" value="Reset" /></td>
				</tr>
				</table>
		</form>
		<?php
		}
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
			<h1>Booking</h1>
			<p>Welcome <?php echo $_SESSION["givenname"], " ", $_SESSION["familyname"]?>,</p>
			<br />
			<?php if (!isset($_POST["submit1"]) && !isset($_POST["submit2"]) && !isset($_POST["submit3"]) &&
				!isset($_POST["submit7"]) && !isset($_POST["submit5"]))
				{ ?>
				<form id="booking1" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<table>
						<tr>
							<td>Date (in format yyyy-mm-dd): </td><td><input type="text" name="date" id="date"></td>
						</tr>
						<tr>
							<td><input type="submit" name="submit1" id="submit" value="Submit" /></td><td><input type="reset"
							name="reset" id="reset" value="Reset" /></td>
						</tr>
					</table>
				</form>
				<?php
				}
				if (isset($_POST["submit1"]))
				{
					$date = $_POST["date"];
					$sql = "SELECT flighttime, leaving, dest FROM flights WHERE flighttime LIKE '$date%'";
					$rs = mysql_query($sql, $conn);
				?>
				<form id="booking2" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<table>
						<tr>
							<td>Available Flights: </td><td><select name="flights" id="flights" size="1">
								<?php while ($row = mysql_fetch_array($rs)) { ?>
									<option value="<?php echo $row["flighttime"]?>"><?php echo "From ", $row ["leaving"], " To ", $row
									["dest"], " On ", $row ["flighttime"]?></option>
								<?php } ?>
							</select></td>
						</tr>
						<tr>
							<td><input type="submit" name="submit2" id="submit" value="Submit" /></td><td><input type="reset"
							name="reset" id="reset" value="Reset" /></td>
						</tr>
					</table>
				</form>
				<?php }
				if (isset($_POST["submit2"]))
				{
					$flighttime = $_POST["flights"];
					$flightIDsql = "SELECT flightID FROM flights WHERE flighttime = '$flighttime'";
					$rsflight = mysql_query($flightIDsql, $conn)
					or die ('Problem with query' . mysql_error());
					while ($row = mysql_fetch_array($rsflight))
					{
						$_SESSION["flightID"] = $row["flightID"];
					}
					$_SESSION["flight"] = $_POST["flights"];
					$flight = $_SESSION["flight"];
					$seatssql = "SELECT seats FROM flights WHERE flighttime = '$flight'";
					$seatsrs = mysql_query($seatssql, $conn)
					or die ('Problem with query' . mysql_error());
					while ($seatsrow = mysql_fetch_array($seatsrs))
					{
						$seats = $seatsrow["seats"];
					}
					$bookedsql = "SELECT booked FROM flights WHERE flighttime = '$flight'";
					$bookedrs = mysql_query($bookedsql, $conn)
					or die ('Problem with query' . mysql_error());
					while ($bookedrow = mysql_fetch_array($bookedrs))
					{
						$booked = $bookedrow["booked"];
					}
					$_SESSION["booked"] = $booked;
					if ($booked >= $seats)
					{
						echo "This flight is full. Please select another flight.";
					}
					else if ($booked < $seats)
					{
					?>
					<form id="booking3" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
						<table>
							<tr>
								<td>Would you like to book a return flight?</td>
								<td>Yes<input type="radio" name="return" value="yes"></td><td>No<input type="radio"
								name="return" value="no"></td>
							</tr>
							<tr>
								<td><input type="submit" name="submit3" id="submit" value="Submit" /></td><td><input
								type="reset" name="reset" id="reset" value="Reset" /></td><td></td>
							</tr>
						</table>
					</form>
					<?php
					}
				}
				if (isset($_POST["submit3"]))
				{
					if ($_POST["return"] == 'yes')
					{
					?>
					<form id="booking4" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
						<table>
							<tr>
								<td>Return Date (in format yyyy-mm-dd): </td><td><input type="text" name="returndate"
								id="returndate"></td>
							</tr>
							<tr>
								<td><input type="submit" name="submit7" id="submit" value="Submit" /></td><td><input type="reset"
								name="reset" id="reset" value="Reset" /></td>
							</tr>
						</table>
					</form>
					<?php
					}
					else if($_POST["return"] == 'no')
					{
						payFlight();
					}
				}
				if (isset($_POST["submit7"]))
				{
					$flight = $_SESSION["flight"];
					$sqlleaving = "SELECT flighttime, leaving FROM flights WHERE flighttime = '$flight'";
					$rsleaving = mysql_query($sqlleaving, $conn)
					or die ('Problem with query' . mysql_error());
					while ($row = mysql_fetch_array($rsleaving)){
						$leaving = $row["leaving"];
					}
					$sqldest = "SELECT flighttime, dest FROM flights WHERE flighttime = '$flight'";
					$rsdest = mysql_query($sqldest, $conn)
					or die ('Problem with query' . mysql_error());
					while ($row = mysql_fetch_array($rsdest)){
						$dest = $row["dest"];
					}
					$returndate = $_POST["returndate"];
					$returntrip = "SELECT dest, leaving, flighttime FROM flights WHERE dest = '$leaving' && leaving =
					'$dest' && flighttime LIKE '$returndate%'";
					$rs3 = mysql_query($returntrip, $conn)
					or die ('Problem with query' . mysql_error());
				?>
				<form id="booking5" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<table>
						<tr>
							<td>Available Return Flights: </td><td><select name="flights" id="flights" size="1">
								<?php while ($row = mysql_fetch_array($rs3)) { ?>
									<option value="
									<?php echo $row["flighttime"]?>"><?php echo "From ", $row ["leaving"], " To ", $row ["dest"], "
									On ", $row ["flighttime"]?></option>
								<?php } ?>
							</select></td>
						</tr>
						<td><input type="submit" name="submit5" id="submit" value="Submit" /></td><td><input type="reset"
						name="reset" id="reset" value="Reset" /></td>
					</tr>
				</table>
			</form>
			<?php
			}
			
			if (isset($_POST["submit6"]))
			{
				function randomID($length = 6)
				{
					$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
					$num = strlen($chars);
					
					$result = "";
					
					for ($i = 0; $i < $length; $i++)
					{
						$index = mt_rand(0, $num - 1);
						$result .= $chars[$index];
					}
					return $result;
				}
				
				if ($_SESSION["admin"] != "False")
				{
					$ff = "N";
					$ffname = "N/A";
				}
				else
				{
					$ff = "Y";
					$ffname = $_SESSION["username"];
					$ffpw = $_SESSION["password"];
					$height = $_SESSION["height"];
					$weight = $_SESSION["weight"];
					$seatpref = $_SESSION["spreference"];
					$mealpref = $_SESSION["mpreference"];
				}
				
				$ref = randomID();
				$givenname = $_SESSION["givenname"];
				$middlename = $_SESSION["middlename"];
				$familyname = $_SESSION["familyname"];
				$address = $_SESSION["address"];
				$state = $_SESSION["state"];
				$postcode = $_SESSION["postcode"];
				$phone = $_SESSION["phone"];
				$email = $_SESSION["email"];
				$ccname = $_POST["ccname"];
				$cctype = $_POST["cctype"];
				$ccnum = $_POST["ccnumber"];
				$ccexp = $_POST["expiry"];
				$ccverify = $_POST["verify"];
				$flightID = $_SESSION["flightID"];
				
				$sqlinsert = "INSERT INTO booking (gname, fname, mname, address, state, postcode, phone, email,
				ref, ff, ffname, ccname, cctype, ccnum, ccexp, ccverify, flightID) VALUES ('$givenname', '$familyname',
				'$middlename', '$address', '$state', '$postcode', '$phone', '$email', '$ref', '$ff', '$ffname',
				'$ccname', '$cctype', '$ccnum', '$ccexp', '$ccverify', '$flightID')";
				
				$booked = $_SESSION["booked"];
				$updateseats = ($booked + 1);
				
				$sqlupdate = "UPDATE flights SET booked='$updateseats' WHERE flightID='$flightID'";
				
				$tableID = str_replace('.', '_', $flightID);
				$checktables = mysql_query("SHOW TABLES LIKE '$tableID'");
				$tableexists = mysql_num_rows($checktables);
				if ($tableexists == 0)
				{
					$create = "CREATE TABLE $tableID (passenger SMALLINT NOT NULL PRIMARY KEY,
					booking CHAR(6), seat VARCHAR(3))";
				}
				
				if(mysql_query($sqlinsert, $conn))
				{
					echo "<br />Booking successful!";
					echo "<br /><br />Your booking ID is: ", $ref;
				}
				else
				{
					echo "ERROR! " . mysql_error($conn);
				}
				
				if ($_SESSION["reg"] = "Y")
				{
					$ffname = $_SESSION["username"];
					$ffpw = $_SESSION["password"];
					$height = $_SESSION["height"];
					$weight = $_SESSION["weight"];
					$seatpref = $_SESSION["spreference"];
					$mealpref = $_SESSION["mpreference"];
					
					$sqlinsert2 = "INSERT INTO ff (gname, fname, mname, address, state, postcode, phone, email,
					ffname, ffpw, height, weight, seatpref, mealpref, ccname, cctype, ccnum, ccexp, ccverify)
					VALUES ('$givenname', '$familyname', '$middlename', '$address', '$state', '$postcode',
					'$phone', '$email', '$ffname', '$ffpw', '$height', '$weight', '$seatpref', '$mealpref',
					'$ccname', '$cctype', '$ccnum', '$ccexp', '$ccverify')";
				}
			}
			if (isset($_POST["submit5"]))
			{
				payFlight();
			}
		mysql_close($conn); ?>
	</div>
</div>
</body>
</html>