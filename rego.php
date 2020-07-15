<!DOCTYPE html>
<html>
	<head>
		<title>Passenger Registration - Region Air</title>
		<meta charset="UTF-8">
		<meta name="description" content="registration, regionAir, frequent, flyer">
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
				var givenname = document.getElementById("givenname").value;
				var familyname = document.getElementById("familyname").value;
				var address = document.getElementById("address").value;
				var state = document.getElementById("state").value;
				var postcode = document.getElementById("postcode").value;
				var phone = document.getElementById("phone").value;
				var email = document.getElementById("email").value;
				
				if (givenname != "" && familyname != "" && address != "" && state != "select" && postcode != "" && phone != "" &&
				email != "")
				{
					return true;
				}
				else
				{
					alert("Please complete the required fields marked with an asterisk (*).");
					return false;
				}
			}
			
			function validateForm2()
			{
				var username = document.getElementById("username").value;
				var password = document.getElementById("password").value;
				var pwordconfirm = document.getElementById("pwordconfirm").value;
				var height = document.getElementById("height").value;
				var weight = document.getElementById("weight").value;
				var spreference = document.getElementById("spreference").value;
				var mpreference = document.getElementById("mpreference").value;
				
				if (password != pwordconfirm)
				{
					alert("Passwords do not match. Please try again.");
					return false;
				}
				else if (username != "" && password != "" && pwordconfirm != "" && height != "" && weight != "" && spreference != "select" && mpreference != "select")
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
	<body><?php
		$conn = mysql_connect("localhost", "twa166", "twa166g5");
		mysql_select_db("airline166", $conn)
		or die ('Database not found ' . mysql_error() );
		session_start();
		$_SESSION["reg"] = "N";
		if (!isset($_POST["submit"]) && !isset($_POST["submit2"]) && !isset($_POST["submit3"]))
		{
			$_SESSION["givenname"] = "";
			$_SESSION["middlename"] = "";
			$_SESSION["familyname"] = "";
			$_SESSION["address"] = "";
			$_SESSION["state"] = "select";
			$_SESSION["postcode"] = "";
			$_SESSION["phone"] = "";
			$_SESSION["email"] = "";
		}
		else if (isset($_POST["submit"]))
		{
			$_SESSION["givenname"] = $_POST["givenname"];
			$_SESSION["middlename"] = $_POST["middlename"];
			$_SESSION["familyname"] = $_POST["familyname"];
			$_SESSION["address"] = $_POST["address"];
			$_SESSION["state"] = $_POST["state"];
			$_SESSION["postcode"] = $_POST["postcode"];
			$_SESSION["phone"] = $_POST["phone"];
			$_SESSION["email"] = $_POST["email"];
		}
		
		?><div id="wrapper">
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
					<li><a href="rego.php" id ="active">Passenger Registration</a></li>
					<li><a href="terms.html">Terms & Conditions</a></li>
				</ul>
			</div>
		</div>
		<div id="body">
			<h1>Passenger Registration</h1>
			<br />
			<form id="rego1" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" onsubmit="return
			validateForm()">
				<table>
					<tr><td>Given Name: <span class = "required">*</span> </td><td><input type="text"
						name="givenname" value="<?php echo $_SESSION["givenname"];?>" id="givenname"
					onblur="requiredField(this);" /></td></tr>
					<tr><td>Middle Name: </td><td><input type="text" name="middlename" value="<?php echo
					$_SESSION["middlename"];?>" id="middlename" /></td></tr>
					<tr><td>Family Name: <span class = "required">*</span> </td><td><input type="text"
						name="familyname" value="<?php echo $_SESSION["familyname"];?>" id="familyname"
					onblur="requiredField(this);" /></td></tr>
					<tr><td>Address: <span class = "required">*</span> </td><td><input type="text"
						size="50" name="address" value="<?php echo $_SESSION["address"];?>" id="address"
					onblur="requiredField(this);" /></td></tr>
					<tr><td>State: <span class = "required">*</span></td><td>
						<select name="state" id="state" size="1">
							<option value="select" disabled <?php if($_SESSION["state"] == 'select'){echo("selected");}?>>--Select--</option>
							<option <?php if($_SESSION["state"] == 'act'){echo("selected");}?> value="act">Australian Capital Territory</option>
							<option <?php if($_SESSION["state"] == 'nsw'){echo("selected");}?> value="nsw">New South Wales</option>
							<option <?php if($_SESSION["state"] == 'nt'){echo("selected");}?> value="nt">Northern Territory</option>
							<option <?php if($_SESSION["state"] == 'qld'){echo("selected");}?> value="qld">Queensland</option>
							<option <?php if($_SESSION["state"] == 'sa'){echo("selected");}?> value="sa">South Australia</option>
							<option <?php if($_SESSION["state"] == 'tas'){echo("selected");}?> value="tas">Tasmania</option>
							<option <?php if($_SESSION["state"] == 'vic'){echo("selected");}?> value="vic">Victoria</option>
							<option <?php if($_SESSION["state"] == 'wa'){echo("selected");}?> value="wa">Western Australia</option>
						</select>
					</td></tr>
					<tr><td>Postcode: <span class = "required">*</span> </td><td><input type="text"
						name="postcode" value="<?php echo $_SESSION["postcode"];?>" id="postcode" size="4"
					maxlength="4" onblur="requiredField(this);" /></td></tr>
					<tr><td>Contact Number: <span class = "required">*</span></td><td><input type="text"
						name="phone" value="<?php echo $_SESSION["phone"];?>" id="phone"
					onblur="requiredField(this);" /></td></tr>
					<tr><td>Email: <span class = "required">*</span></td><td><input type="text"
						name="email" value="<?php echo $_SESSION["email"];?>" id="email"
					onblur="requiredField(this);" /></td></tr>
					</table><?php
					if (!isset($_POST["submit"]) && !isset($_POST["submit2"]) && !isset($_POST["submit3"]))
					{
					?><p><span class="required">* Required Fields</span></p>
					<br />
					<input type="submit" name="submit" value="Submit" onclick = "return validateForm()" /><?php }
				?></form><?php
				if (isset($_POST["submit"]))
				{
					?><form id="rego2" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<br />
					<p>I would like to join Region Air's frequent flyer programme <input type="checkbox"
					name="ffp" /></p>
					<br />
					<input type="submit" name="submit2" value="Submit" />
					</form><?php
				}
				if (isset($_POST["ffp"]))
				{
					$_SESSION["reg"] = "Y";
					if (isset($_POST["submit2"]) || (isset($_POST["submit3"])))
					{ ?>
					<form id="rego3" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post"
					onsubmit="return validateForm2()">
						<br />
						<p>I would like to join Region Air's frequent flyer programme <input type="checkbox"
						name="ffp" checked /></p>
						<br />
						<table>
							<tr><td>Username: <span class = "required">*</span> </td><td><input type="text"
							name="username" id="username" onblur="requiredField(this);" /></td></tr>
							<tr><td>Password: <span class = "required">*</span> </td><td><input type="password"
							name="password" id="password" onblur="requiredField(this);" onblur="requiredField(this);" /></td></tr>
							<tr><td>Password Confirm: <span class = "required">*</span> </td><td><input
								type="password" name="pwordconfirm" id="pwordconfirm" onblur="requiredField(this);"
							/></td></tr>
							<tr><td>Height in metres: <span class = "required">*</span> </td><td><input
							type="text" name="height" id="height" onblur="requiredField(this);" /></td></tr>
							<tr><td>Weight in kilos: <span class = "required">*</span> </td><td><input
							type="text" name="weight" id="weight" onblur="requiredField(this);" /></td></tr>
							<tr><td>Seat Preference: <span class = "required">*</span></td><td>
								<select name="spreference" id="spreference" size="1">
									<option value="select" disabled selected>--Select--</option>
									<option value="window">Window</option>
									<option value="middle">Middle</option>
									<option value="aisle">Aisle</option>
								</select>
								<tr><td>Meal Preference: <span class = "required">*</span></td><td>
									<select name="mpreference" id="mpreference" size="1">
										<option value="select" disabled selected>--Select--</option>
										<option value="tasty">Tasty</option>
										<option value="horrible">Horrible</option>
										<option value="vegan">Vegan</option>
										<option value="none">No Preference</option>
									</select>
								</table>
								<p><span class="required">* Required Fields</span></p>
								<br />
								<input type="submit" name="submit3" value="Confirm Submit" onclick = "return validateForm2()" />
								<br />
								<?php
									if (isset($_POST["submit3"]))
									{
										$_SESSION["username"] = $_POST["username"];
										$_SESSION["password"] = $_POST["password"];
										$_SESSION["pwordconfirm"] = $_POST["pwordconfirm"];
										$_SESSION["height"] = $_POST["height"];
										$_SESSION["weight"] = $_POST["weight"];
										$_SESSION["spreference"] = $_POST["spreference"];
										$_SESSION["mpreference"] = $_POST["mpreference"];
										$username = $_SESSION["username"];
										$sql = "SELECT ffname FROM ff WHERE ffname = '$username'";
										$rs = mysql_query($sql, $conn);
										if (mysql_num_rows($rs)>0)
										{
											echo "<br /><p><span class='required'>Username taken. Please select a different username.</span></p>";
										}
										else if ($_SESSION["pwordconfirm"] != $_SESSION["password"])
										{
											echo "<br /><p><span class='required'>Passwords do not match. Please try again.</span></p>";
										}
										else if ($_SESSION["pwordconfirm"] == "" || $_SESSION["password"] == "")
										{
											echo "<br /><p><span class='required'>Please enter a password.</span></p>";
										}
										else
										{
											header("location: booking.php");
										}
									}
								}
								}
								else if (isset($_POST["submit2"]))
								{
									$_SESSION["reg"] = "N";
									?><form id="rego4" action="booking.php" method="post">
									<br />
									<p>I would like to join Region Air's frequent flyer programme <input type="checkbox"
									name="ffp" /></p>
									<br />
									<input type="submit" name="submit4" value="Confirm Submit" />
									<br />
									</form><?php
								}
							mysql_close($conn); ?>
							</div>
						</div>
					</body>
				</html>																