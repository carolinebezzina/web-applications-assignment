<!DOCTYPE html>
<html>
	<head>
		<title>Administrator Login - Region Air</title>
		<meta charset="UTF-8">
		<meta name="description" content="administration, regionAir, login">
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
						<li><a href="adminlogin.php" id ="active">Administrator Login</a></li>
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
				<h1>Administrator Login</h1>
				<form id="adminlogin" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
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
					
					if (isset($_REQUEST["submit"]))
					{
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
								$sql = "SELECT username, password, gname, surname FROM administrators WHERE username = '$username' AND password = '$password'";
								$rs = mysql_query($sql, $conn)
								or die ('Problem with query' . mysql_error());
								if (mysql_num_rows($rs)>0)
								{
									$_SESSION["admin"] = "True";
									while ($row = mysql_fetch_array($rs)){
										$_SESSION["givenname"] = $row["gname"];
										$_SESSION["familyname"] = $row["surname"];
									}
									header("location: admin.php");
								}
								else
								{
									echo "<br /><p><span class='required'>Incorrect username and/or password.</span></p>";
								}
							}
						}
					}
					
				mysql_close($conn); ?>
				</div>
			</div>
		</body>
	</html>
