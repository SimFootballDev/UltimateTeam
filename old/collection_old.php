<?php


// Initialize the session
//session_start();

include "config.php";
include "user.php";
 
// initialise variables
global $acctID;
global $acctCash;
global $acctUpdated;
global $sqlCards;
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Check connection
if (mysqli_connect_errno($link)) {

    echo "Failed to connect to Database: " . mysqli_connect_error();

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
				  pa.position, pa.playerLastName, t.teamName, CardNum, Frame ";
		
		$orderBy = array('rarity', 'code', 'count', 'position', 'team', 'lastname');
		
		if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
			switch($_GET['orderBy']) {
				case 'rarity':
					$order = 'ORDER BY r.cardRarityID DESC';
				break;
				
				case 'code':
					$order = 'ORDER BY CardCode ASC';
				break;
				
				case 'count':
					$order = 'ORDER BY PAcount DESC';
				break;
				
				case 'position':
					$order = 'ORDER BY pa.position ASC';
				break;
				
				case 'team':
					$order = 'ORDER BY t.TeamName ASC';
				break;
				
				case 'lastname':
					$order = 'ORDER BY pa.playerLastName ASC';
				break;
				
				default:
					// default order by
					$order = 'ORDER BY CardCode ASC';
				break;
			}
		} else {
			$order = 'ORDER BY CardCode ASC';
		}
		
		// add the correct order by clause
		$qryCards = $qryCards.$order;
		
		//echo $qryCards;
		
		$sqlCards = mysqli_query($link,$qryCards);
		
		// store total collection size
		$numCards = mysqli_num_rows($sqlCards);
		
	} else {
		
		// no cards in collection
		$numCards = 0;
		
	}
	
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Collection</title>
	<?php include "./scripts.php"; ?>
</head>
<body>
	<div id="main">
		<?php include "./menu.php"; ?>
		<div class="page-header">
			Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.
			<a href="dashboard.php" class="return" style="float: right;">Dashboard</a>
			<br /><br />
		</div>
		<p>
			<?php echo "You have " . $collectionSize . " cards in your collection (" . $numCards . " unique):"; ?>
			<br /><br />
			<div class="table-responsive">
				<table class="table">
					<tr style="font-size: 16px;">
						<th><a href="?orderBy=count">Count</a></th>
						<th><a href="?orderBy=code">Code</a></th>
						<th><a href="?orderBy=rarity">Rarity</a></th>
						<th><a href="?orderBy=position">Pos</a></th>
						<th><a href="?orderBy=lastname">Last Name</a></th>
						<th><a href="?orderBy=team">Team</a></th>
					</tr>
			<!-- do stuff here to allow viewing their collection -->
			<?php 
				while($row = mysqli_fetch_assoc($sqlCards)) {
					
					//echo $row["PAcount"] . "x card " . $row["PA"] . "<br />";
																				
					// add new row to table
					echo "<tr>";
					echo "<td>" . $row["PAcount"] . "</td>";
					echo "<td>" . $row["CardCode"] . "</td>";
					echo "<td>" . $row["Rarity"] . "</td>";
					echo "<td>" . $row["Pos"] . "</td>";
					echo "<td>" . $row["LastName"] . "</td>";
					echo "<td>" . $row["Team"] . "</td>";
					echo "</tr>";
					
				}
			?>
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