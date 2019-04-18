<?php

include "config.php";
include "user.php";

// include transaction checking queries
include "checks.php";
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$displayHTML = '';
$errorFlag = false;
$purchaseMade = false;

// check for starter deck code
if (isset($_GET['starterDeck'])) {
	
	// if present... 
	if ($_GET['starterDeck']==1) {
		
		// log the transaction


		
		// add the starter deck cards to the account
		$sql = "INSERT INTO accountCollections 
				SELECT " . $_SESSION['acctID'] . ", pa.playerAttributesID, NOW() 
				FROM playerAttributes pa
				WHERE pa.redemptionCode = 'BASE';";
		
		$result = mysqli_query($link, $sql);
					
		// and display them on load
			
			// build HTML for the new cards
			$displayHTML = 'You redeemed the starter deck ... I\'ll build the HTML for this later.';
			
			// set flag to say new cards were acquired
			$purchaseMade = true;

	} 
	
}

// check for redeem code
if (isset($_GET['redeemCode']) && isset($_GET['redeem'])) {
	
	// is it valid?
	if (in_array($_GET['redeemCode'], $validCodes)) {
		
		// if so, log the transaction
		
		
		
		// award the card(s)
		$sql = "";
			
		// display them on load
					
			// build HTML for the new cards
			$displayHTML = 'You redeemed something ... I\'ll build the HTML for this later.';
			
			// set flag to say new cards were acquired
			$purchaseMade = true;
	
	} else {
		
		// if not, display error
		$displayHTML = 'You entered a redemption code that is not valid.';
	
		// set the error flag
		$errorFlag = true;
	
	}
	
}

// now check if the user is buying a pack
if (isset($_GET['buyPack']) && $_GET['buyPack']=="1") {
	
	// subtract the cost from their total
	$cashLeft = $_SESSION['acctCash'] - 10;
	
	// can they afford it?
	if ($cashLeft>0) {
		
		// log the transaction
		
		
		
		// draw the cards
		
		// assign to the account

		// update cash
		$sql = "";
		
			// display them on load
			$displayHTML = 'You have purchased a pack ... etc etc etc';
			$displayHTML = $displayHTML . '<br />Your balance will be adjusted accordingly.';
	
			// set flag to say new cards were acquired
			$purchaseMade = true;
				
	} else {
		
		// if not enough coins, display error message
		$displayHTML = 'You do not have enough coins to buy a pack right now.';
		$displayHTML = $displayHTML . '<br />Packs cost 10 coins, and you only have ' . $_SESSION['acctCash'] . '.';
		
	}
	
}	

// if no params passed, load as normal

	// check how many packs bought this week
	// if greater than 1, disable the buy packs button
	if ($txThisWeek > 1 || $_SESSION['acctCash'] < 10) {
		$toggleBuy = ' disabled';
	} else {
		$toggleBuy = '';
	}
	
	// check if starter deck has been bought
	// if not, show the starter deck purchase button
	if ($hasStarter==0) {
		$canBuyStarter = true;
	} else {
		$canBuyStarter = false;
	}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Get Cards</title>
	<?php include "./scripts.php"; ?>
</head>
<body>
	<div id="main">
		<?php include "./menu.php"; ?>
		<div class="page-header">
			Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.
			<a href="dashboard.php" class="return" style="float: right;">Dashboard</a>
			<br /><br />
			Passed: [ <?php echo htmlspecialchars($_GET['buyPack']); ?> ] (buying a pack)<br />
			Passed: [ <?php echo htmlspecialchars($_GET['redeemCode']); ?> ] (redeeming a code)
			<br /><br />
<!--
			<?php 
				for($x = 0; $x < count($validCodes); $x++) {
					echo $validCodes[$x];
					echo "<br />";
				}
			?>
-->
			<br /><br />
		</div>
		<!-- display the cards acquired here, if the user just bought some -->
		<?php 
		if ($purchaseMade || $errorFlag) { 
			echo $displayHTML; 		
			echo '<br /><hr /><br /><br />';
			} 
		?>
		
		<!-- do stuff here to allow buying packs or redeeming a code -->
		<?php
		if ($canBuyStarter) {
			echo '
			<form action="buy.php" method="get" class="form-inline">
				<input type="hidden" id="starterDeck" name="starterDeck" value="1">
				<button type="submit" class="btn btn-primary mb-2">Get Starter Deck</button>
			</form>
			<br />';
		}
		?>
		<br />
		<div class="form-group col-md-10">
			<form action="buy.php" method="get" class="form-inline">
				<label for="currentBalance" class="col-sm-4 col-form-label">Balance:</label>
				<input type="text" readonly class="form-control-plaintext" name="currentBalance" value="<?php echo htmlspecialchars($_SESSION["acctCash"]); ?>">
				<input type="text" name="buyPack" value="1" hidden />
				<a href="?buyPack=1" class="btn btn-primary mb-2"<?php echo $toggleBuy ?>>Buy a Pack</a>
			</form>
		</div>
		<br /><br />
		<div class="form-group col-md-10">
			<form action="buy.php" method="get" class="form-inline">
				<label for="redeemCode" class="col-sm-4 col-form-label">Redemption Code:</label>
				<input type="text" class="form-control" name="redeemCode" placeholder="e.g. FREEBOTS">
				<input type="text" name="redeem" value="1" hidden />
				<button type="submit" class="btn btn-primary mb-2">Redeem Code</button>
			</form>
		</div>
		<br /><br />
		
		<p>
			<a href="dashboard.php" class="btn btn-default">Return to the Dashboard</a>
			<a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
		</p>
	</div>
</body>
</html>