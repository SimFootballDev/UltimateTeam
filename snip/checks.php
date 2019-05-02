<?php

require_once $appRoot . "config.php";

$txThisWeek = 0;
$hasStarter = 0;

// Check connection
if (mysqli_connect_errno($link)) {

    echo "Failed to connect to Database: " . mysqli_connect_error();

} else {
	
	// get list of available card sets
	$sql = "SELECT * FROM cardSets WHERE available=1";
	
	$result = mysqli_query($link,$sql);
	
	$listOfSets = array();
	while($row = mysqli_fetch_assoc($result)) {
		array_push($listOfSets,$row['cardSet']);
	}
	
	debug_to_console('List of card sets available to buy:');
	debug_to_console($listofSets);
	
//---------------------------------------------------------

	// get valid redemption code list
	// exclude 'BASE' otherwise players can get the starter deck for free
	$sql = "SELECT DISTINCT redemptionCode FROM playerAttributes WHERE redemptionCode<>'BASE'";
		
	$result = mysqli_query($link,$sql);
	
	$validCodes = array();
	while($row = mysqli_fetch_assoc($result)) {
		array_push($validCodes,$row['redemptionCode']);
	}

	debug_to_console('List of valid redemption codes:');
	debug_to_console($validCodes);
	
//---------------------------------------------------------

	// get all past redeemed codes for this account
	$sql = "SELECT DISTINCT redemptionCode FROM transactions WHERE redemptionCode IS NOT NULL AND accountID =" . $_SESSION['acctID'] . ";";
			
	debug_to_console($sql);
	
	$result = mysqli_query($link,$sql);
	$pastRedeems = array();
	while($row = mysqli_fetch_assoc($result)) {
		array_push($pastRedeems,$row['redemptionCode']);
	}

	debug_to_console('List of codes redeemed by this account already:');
	debug_to_console($pastRedeems);
	
//---------------------------------------------------------
	
	// get transaction info for this account
	$sql = "SELECT SUM(txWeek) AS txThisWeek, SUM(startRedeem) AS hasStarter
			FROM (
				SELECT userID, a.accountID, count(transactionID) AS txWeek, 0 AS startRedeem 
				FROM accounts a 
				INNER JOIN transactions t ON a.accountID=t.accountID 
				INNER JOIN transactionType tt ON t.transactionTypeID=tt.transactionTypeID 
				WHERE a.accountID=" . $_SESSION['acctID'] . " AND t.transactionTypeID=2 AND transactionDate >= LastMonday() 
				UNION ALL 
				SELECT userID, a.accountID, 0 AS txWeek, CASE WHEN redemptionCode='STARTERS' THEN 1 ELSE 0 END AS startRedeem 
				FROM accounts a 
				INNER JOIN transactions t ON a.accountID=t.accountID 
				INNER JOIN transactionType tt ON t.transactionTypeID=tt.transactionTypeID 
				WHERE a.accountID=" . $_SESSION['acctID'] . " 
				) AS userTx
			GROUP BY userID, accountID";
			
	$result = mysqli_query($link,$sql);
		
	if (!is_null($result)) {
		$txRows = mysqli_num_rows($result);
	} else {
		$txRows = 0;
	}
			
	if ($txRows > 0) {
	
		// pass query result to array
		$txInfo = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		// store the info for later
		$_SESSION['txThisWeek'] = $txInfo['txThisWeek'];
		$_SESSION['hasStarter'] = $txInfo['hasStarter'];
				
		$txThisWeek = $txInfo['txThisWeek'];
		$hasStarter = $txInfo['hasStarter'];
		
	} else {
		
		// could not find any transactions
		$_SESSION['txThisWeek'] = 0;
		$_SESSION['hasStarter'] = 0;
		
	}
	
}

?>