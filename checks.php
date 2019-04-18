<?php

include "config.php";

$txThisWeek = 0;
$hasStarter = 0;

// Check connection
if (mysqli_connect_errno($link)) {

    echo "Failed to connect to Database: " . mysqli_connect_error();

} else {
	
	// get valid redemption code list
	$sql = "SELECT DISTINCT redemptionCode FROM playerAttributes";
	
	$result = mysqli_query($link,$sql);
	
	$validCodes = array();
	while($row = mysqli_fetch_assoc($result)) {
		array_push($validCodes,$row['redemptionCode']);
	}
	
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
			
	//echo "Query: " . $sql;
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