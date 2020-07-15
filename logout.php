<?php
session_start();
if ($_SESSION["admin"] == "False")
{
	$admin = "False";
}
else if ($_SESSION["admin"] == "True")
{
	$admin = "True";
}
header("Cache-Control: no-cache");
header("Expires: -1");
session_destroy();
if ($admin == "False")
{
	header("location: fflogin.php");
}
else if ($admin == "True")
{
	header("location: adminlogin.php");
}
?>