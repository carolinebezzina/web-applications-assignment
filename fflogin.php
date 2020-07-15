<!DOCTYPE html>
<html>
	<head>
		<title>Frequent Flyer Login - Region Air</title>
		<meta charset="UTF-8">
		<meta name="description" content="regionAir, frequent, flyer, login">
		<link rel="stylesheet" href="assign.css" type="text/css" />
	</head>
	<body>
		<?php
			session_start();
			$conn = mysql_connect("localhost", "twa166", "twa166g5");
			mysql_select_db("airline166", $conn)
			or die ('Database not found ' . mysql_error() );
		?>
		<div id="wrapper">
			<div id="header">
				<div id ="login">
					<ul>
						<li><a href="logout.php">Logout</a></li>
						<li><a href="adminlogin.php">Administrator Login</a></li>
						<li><a href="fflogin.php" id ="active">Frequent Flyer Login</a></li>
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
				<h1>Frequent Flyer Login</h1>
				<form id="fflogin" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<table>
						<tr>
							<td>Username: </td><td><input type="text" name="username" /></td>
						</tr>
						<tr>
							<td>Password: </td><td><input type="password" name="password" /></td>
						</tr>
						<tr>
							<td><input type="submit" name="submit" value="Submit" /></td><td><input type=
							"reset" /></td>
						</tr>
					</table>
				</form>
				<?php
					if (isset($_POST["submit"]))
					{
						$username = $_POST["username"];
						$password = $_POST["password"];
						if (empty($username) || empty($password))
						{
							echo "<br /><p><span class='required'>Please enter a username and password.</span></p>";
						}
						else
						{
							$sql = "SELECT * FROM ff WHERE ffname = '$username' AND ffpw = '$password'";
							$rs = mysql_query($sql, $conn)
							or die ('Problem with query' . mysql_error());
							if (mysql_num_rows($rs)>0)
							{
								$_SESSION["reg"] = "N";
								$_SESSION["admin"] = "False";
								while ($row = mysql_fetch_array($rs)){
									$_SESSION["givenname"] = $row["gname"];
									$_SESSION["middlename"] = $row["mname"];
									$_SESSION["familyname"] = $row["fname"];
									$_SESSION["address"] = $row["address"];
									$_SESSION["state"] = $row["state"];
									$_SESSION["postcode"] = $row["postcode"];
									$_SESSION["phone"] = $row["phone"];
									$_SESSION["email"] = $row["email"];
									$_SESSION["username"] = $row["ffname"];
									$_SESSION["password"] = $row["ffpw"];
									$_SESSION["height"] = $row["height"];
									$_SESSION["weight"] = $row["weight"];
									$_SESSION["spreference"] = $row["seatpref"];
									$_SESSION["mpreference"] = $row["mealpref"];
								}
								header("location: booking.php");
							}
							else
							{
								echo "<br /><p><span class='required'>Incorrect username and/or password.</span></p>";
							}
						}
					}
				mysql_close($conn); ?>
			</div>
		</div>
	</body>
</html>
