<?php

// Initialize the session
//session_start();

require_once "./config.php";
require_once $snipPath . "user.php";
 
// initialise variables
global $acctID;
global $acctCash;
global $acctUpdated;
global $sqlCards;
global $announce;
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Check connection
if (mysqli_connect_errno($link)) {

    $announce = "Failed to connect to Database: " . mysqli_connect_error();

} else {

	mysqli_query($link, "SET NAMES UTF8");

	//echo "Username: " . $_SESSION["username"];
	
	// get account info for this user
	$sql = "SELECT a.accountID, l.userID, a.acctBalance, a.lastUpdate, l.username 
	        FROM accounts a 
			INNER JOIN logins l ON l.userID = a.userID 
			WHERE l.username='" . $_SESSION["username"] . "'";
			
	$result = mysqli_query($link,$sql);
		
	if (!is_null($result)) {
		$acctRows = mysqli_num_rows($result);
		//echo "\nAccount found.";
	} else {
		$acctRows = 0;
		//echo "\nAccount NOT found.";
	}
			
	if ($acctRows > 0) {
	
		// pass query result to array
		$acctInfo = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		// store the info for later
		$SESSION['acctID'] = $acctInfo['accountID'];
		$acctID = $acctInfo['accountID'];
		$acctCash = $acctInfo['acctBalance'];
		$acctUpdated = $acctInfo['lastUpdate'];
		
	} else {
		
		// could not find this user's account
		$SESSION['acctID'] = 0;
		
	}
	
	//echo "\nAccount ID: " . $acctID;
	//echo "\nCash: " . $acctCash;
	//echo "\nUpdated: " . $acctUpdated;
	
	// how many cards in this person's collection
	$sqlCollection = mysqli_query($link,"SELECT * FROM accountCollections WHERE accountID=" . $acctID);
	$collectionSize = mysqli_num_rows($sqlCollection);
		
	if ($collectionSize > 0) {
		
		// get full collection details
		$qryCards = "SELECT pa.playerAttributesID AS PAid, 
						   COUNT(ac.playerAttributesID) AS PAcount, 
						   CONCAT(COALESCE(s.setCode,'XXX'),'-',LPAD(pa.setNumber,3,'0')) AS CardCode,
						   r.cardRarityDesc AS Rarity, 
						   pa.position AS Pos, 
						   pa.playerLastName AS LastName, 
						   t.teamName AS Team, 
						   LPAD(pa.setNumber,3,'0') AS CardNum, 
						   r.cardRarityID AS Frame 
					 FROM playerAttributes pa 
					 INNER JOIN teams t ON pa.teamID=t.teamID 
					 INNER JOIN cardRarity r on r.cardRarityID=pa.cardRarityID 
					 INNER JOIN cardSets s on s.cardSetID=pa.cardSetID 
					 INNER JOIN accountCollections ac ON ac.playerAttributesID=pa.playerAttributesID 
					 WHERE ac.accountID = ".$acctID." 
					 GROUP BY ac.playerAttributesID, CardCode, r.cardRarityDesc, 
							  pa.position, pa.playerLastName, t.teamName, CardNum, Frame 
					 ORDER BY CardCode ASC;";
		
		$sqlCards = mysqli_query($link,$qryCards);
		
		// store total collection size
		$numCards = mysqli_num_rows($sqlCards);
		
	} else {
		
		// no cards in collection
		$numCards = 0;
		
	}
	
	$announce = "You have " . $collectionSize . " cards in your collection ";
	
	if($numCards>0) {
		$announce = $announce . "(" . $numCards . " unique)";
	}
	
}

//debug_to_console('Style: ' . $_SESSION['style']);
$tableClass = "table table-hover table-striped table-bordered";
if ($_SESSION['style']=='dark') {
	$tableClass . ' table-dark'; 
	} 

//debug_to_console($tableClass);

//debug_to_console($snipPath . "scripts.php");
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Collection</title>
	<?php include $appRoot . "scripts.php"; ?>
	<script type="text/javascript" class="init">
		$(document).ready(function() {
			$('#collection').DataTable( {
				paging: false,
				scrollY: "450px",
				scrollCollapse: true
			});
		} );
	</script>	
</head>
<body>
	<div id="main">
		<?php include $snipPath . "menu.php"; ?>
		<div class="page-header">
			Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.
			<a href="dashboard.php" class="return" style="float: right;">Dashboard</a>
			<br /><br />
		</div>
		<p>
			<?php echo $announce ?>
			<br /><br />
			<div class="table-responsive">
				<table id="collection" class=<?php echo $tableClass ?>>
					<thead>
						<tr>
							<th>Count</th>
							<th>Code</th>
							<th>Rarity</th>
							<th>Pos</th>
							<th>Last Name</th>
							<th>Team</th>
						</tr>
					</thead>
					<tbody>
			<!-- do stuff here to allow viewing their collection -->
			<?php 
				while($row = mysqli_fetch_assoc($sqlCards)) {
					
					//echo $row["PAcount"] . "x card " . $row["PA"] . "<br />";
																				
					// add new row to table
					echo "\t<tr>\n";
					echo "\t\t<td>" . $row["PAcount"] . "</td>\n";
					echo "\t\t<td>" . $row["CardCode"] . "</td>\n";
					echo "\t\t<td>" . $row["Rarity"] . "</td>\n";
					echo "\t\t<td>" . $row["Pos"] . "</td>\n";
					echo "\t\t<td>" . $row["LastName"] . "</td>\n";
					echo "\t\t<td>" . $row["Team"] . "</td>\n";
					echo "\t</tr>";
					
				}
			?>		
					</tbody>
				</table>
			</div>
		</p>
		<p>
			<a href="dashboard.php" class="btn btn-default">Return to the Dashboard</a>
			<a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
		</p>
	</div>
</body>
</html>