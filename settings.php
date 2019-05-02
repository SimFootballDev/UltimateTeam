<?php

require_once "./config.php";
require_once "./snip/user.php";

// define acceptable style values
$styleList = array('dark','light');

debug_to_console($_GET["style"]);

// check user is logged in and a style value has been passed
if(isset($_GET["style"]) && isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

	// is the style value valid?
	if (in_array($_GET['style'], $styleList)) {
		
		// update the user table
		$sql = "UPDATE logins SET style='" . $_GET['style'] . "' WHERE userID = " . $_SESSION['id'] . ";";

		debug_to_console("Updating style preference...");
		debug_to_console($sql);
		
		if(mysqli_query($link, $sql)) {
			debug_to_console("Updated style preference successfully.");
		} else {
			debug_to_console("Error: " . mysqli_error($link));
		}

	}
	
}

// return to the dashboard
header("location: dashboard.php");
exit;

?>