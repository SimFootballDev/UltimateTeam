<?php

require_once $appRoot . "config.php";

// initialise variables
$acctID = 0;
$acctCash = 0;
$acctUpdated = 0;
$isAdmin = 0;

// Check connection
if (mysqli_connect_errno($link)) {

    echo "Failed to connect to Database: " . mysqli_connect_error();

} else {
	
	// get account info for this user
	$sql = "SELECT COALESCE(a.accountID,0) AS acctID, l.userID, l.username, l.isAdmin, l.style, 
	               COALESCE(a.acctBalance, 0) AS acctCash, COALESCE(a.lastUpdate, 'Never') AS lastUpdate
	        FROM logins l 
			LEFT JOIN accounts a ON l.userID = a.userID 
			WHERE l.username='" . $_SESSION["username"] . "'";
			
	//echo "Query: " . $sql;
	$result = mysqli_query($link,$sql);
		
	if (!is_null($result)) {
		$acctRows = mysqli_num_rows($result);
	} else {
		$acctRows = 0;
	}
			
	if ($acctRows > 0) {
	
		// pass query result to array
		$acctInfo = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		// store the info for later
		$_SESSION['acctID'] = $acctInfo['acctID'];
		$_SESSION['acctCash'] = $acctInfo['acctCash'];
		$_SESSION['isAdmin'] = $acctInfo['isAdmin'];
		$_SESSION['style'] = $acctInfo['style'];
		$_SESSION['acctUpdated'] = $acctInfo['lastUpdate'];
		
		$acctID = $acctInfo['accountID'];
		$acctCash = $acctInfo['acctBalance'];
		$isAdmin = $acctInfo['isAdmin'];
		$style = $acctInfo['style'];
		$acctUpdated = $acctInfo['lastUpdate'];
		
	} else {
		
		// could not find this user's account
		$_SESSION['acctID'] = 0;
		
	}
	
}

?>