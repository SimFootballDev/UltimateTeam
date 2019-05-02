<?php

require_once "./config.php";
require_once $snipPath ."user.php";

// include transaction checking queries
include $snipPath . "checks.php";
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$displayHTML = '';
$errorFlag = false;
$purchaseMade = false;

// check for starter deck code
if (isset($_POST['starterDeck'])) {
	
	$cost = $_POST['starterCost'];
	
	// if present... 
	if ($_POST['starterDeck']==1) {
		
		// log the transaction
		$sql = "INSERT INTO transactions ( accountID, transactionAmount, transactionTypeID, redemptionCode ) 
				VALUES ( " . $_SESSION['acctID'] . ", " . $cost . ", 5, " . $_POST['redeemCode'] . " );";
		
	/*
		debug_to_console("Adding transaction...");
		debug_to_console($sql);
		
		if(mysqli_query($link, $sql)) {
			debug_to_console("Added transaction successfully.");
		} else {
			debug_to_console("Error: " . mysqli_error($link));
		}
	*/
	
		// add the starter deck cards to the account
		$sql = "INSERT INTO accountCollections 
				SELECT " . $_SESSION['acctID'] . ", pa.playerAttributesID, NOW() 
				FROM playerAttributes pa
				WHERE pa.redemptionCode = 'BASE';";
	
	/*
		debug_to_console("Adding starter deck cards...");
		debug_to_console($sql);
		
		if(mysqli_query($link, $sql)) {
			debug_to_console("Added cards successfully.");
		} else {
			debug_to_console("Error: " . mysqli_error($link));
		}
	*/			
	
		// and display them on load
			
			// build HTML for the new cards
			$displayHTML = 'You redeemed the starter deck ... I\'ll build the HTML for this later.';
			
			// set flag to say new cards were acquired
			$purchaseMade = true;

	} 
	
}

// check for redeem code
if (isset($_POST['redeemCode']) && isset($_POST['redeem'])) {
	
	$cost = $_POST['redeemCost'];
	
	// is it valid?
	if (in_array($_POST['redeemCode'], $validCodes)) {
		
		// if so, make sure they havent already redeemed it
		if (!in_array($_POST['redeemCode'], $pastRedeems)) {
		
			// if not redeemed yet, log the transaction
			$sql = "INSERT INTO transactions ( accountID, transactionAmount, transactionTypeID, redemptionCode ) 
			        VALUES ( " . $_SESSION['acctID'] . ", " . $cost . ", 3, '" . $_POST['redeemCode'] . "' );";
		
		/*	
			debug_to_console("Adding transaction...");
			debug_to_console($sql);
			
			if(mysqli_query($link, $sql)) {
				debug_to_console("Added transaction successfully.");
			} else {
				debug_to_console("Error: " . mysqli_error($link));
			}
		*/
		
			// award the card(s)
			$sql = "INSERT INTO accountCollections 
			        SELECT " . $_SESSION['acctID'] . " AS playerAccount, 
					       playerAttributesID AS cardRedeemed, 
						   NOW() AS drawTimestamp
					WHERE redemptionCode = '" . $_POST['redeemCode'] . "';";
				
		/*
			debug_to_console("Adding cards to account...");
			debug_to_console($sql);
			
			if(mysqli_query($link, $sql)) {
				debug_to_console("Added cards successfully.");
			} else {
				debug_to_console("Error: " . mysqli_error($link));
			}
		*/	
		
			// display them on load
						
				// build HTML for the new cards
				$displayHTML = 'You redeemed something ... I\'ll build the HTML for this later.';
				
				// set flag to say new cards were acquired
				$purchaseMade = true;
				
		} else {
			
			$displayHTML = 'You have already redeemed this code!';
				
			// set the error flag
			$errorFlag = true;

		}
		
	} else {
		
		// if not, display error
		$displayHTML = 'You entered a redemption code that is not valid.';
	
		// set the error flag
		$errorFlag = true;
	
	}
	
}

// now check if the user is buying a pack
if (isset($_POST['buyPack']) && $_POST['buyPack']=="1") {
	
	$cost = $_POST['packCost'];
	
	// subtract the cost from their total
	$cashLeft = $_SESSION['acctCash'] - $cost;
	
	// can they afford it?
	if ($cashLeft>0) {
		
		// log the transaction
		$sql = "INSERT INTO transactions ( accountID, transactionAmount, transactionTypeID ) 
				VALUES ( " . $_SESSION['acctID'] . ", " . $cost . ", 2 );";	
		
		debug_to_console("Adding transaction...");
		debug_to_console($sql);
				
		if(mysqli_query($link, $sql)) {
			debug_to_console("Added transaction successfully.");
			// update cash
			$_SESSION['acctCash'] -= $cost;
		} else {
			debug_to_console("Error: " . mysqli_error($link));
		}
		
		// draw the cards
		
		
		
		// assign to the account

		
		
			// display them on load
			$displayHTML = 'You have purchased a pack ... etc etc etc';
			$displayHTML = $displayHTML . '<br />Your balance will be adjusted accordingly.';
	
			// set flag to say new cards were acquired
			$purchaseMade = true;
				
	} else {
		
		// if not enough coins, display error message
		$displayHTML = 'You do not have enough coins to buy a pack right now.';
		$displayHTML = $displayHTML . '<br />Packs cost ' . $cost . ' coins, and you only have ' . $_SESSION['acctCash'] . '.';
		
	}
	
}	

// if no params passed, load as normal

	// check how many packs bought this week
	// if greater than 1, disable the buy packs button
	if ($txThisWeek > 1) {
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
	<?php include $appRoot . "scripts.php"; ?>
</head>
<body>
	<div id="main">
		<?php include $snipPath . "menu.php"; ?>
		<div class="page-header">
			Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.
			<a href="dashboard.php" class="return" style="float: right;">Dashboard</a>
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
			<form action="buy.php" method="post" class="form-inline">
				<input type="hidden" id="starterDeck" name="starterDeck" value="1">
				<input type="hidden" id="starterCost" name"starterCost" value="25">
				<button type="submit" class="btn btn-primary mb-2">Get Starter Deck</button>
			</form>
			<br />';
		}
		?>
		<br />
		<div class="form-group col-md-10">
			<form action="buy.php" method="post" class="form-inline">
				<label for="currentBalance" class="col-sm-4 col-form-label">Balance:</label>
				<input type="text" readonly class="form-control-plaintext" name="currentBalance" value="<?php echo htmlspecialchars($_SESSION["acctCash"]); ?>">
				<input type="text" name="buyPack" value="1" hidden />
				<input type="text" name="packCost" value="10" hidden />
				<input type="text" name="txID" value="<?php ?>" hidden />
				<button type="submit" class="btn btn-primary mb-2"<?php echo $toggleBuy ?>>Buy a Pack</a>
			</form>
		</div>
		<br /><br />
		<div class="form-group col-md-10">
			<form action="buy.php" method="post" class="form-inline">
				<label for="redeemCode" class="col-sm-4 col-form-label">Redemption Code:</label>
				<input type="text" class="form-control" name="redeemCode" placeholder="e.g. FREEBOTS">
				<input type="text" name="redeem" value="1" hidden />
				<input type="text" name="redeemCost" value="0" hidden />
				<input type="text" name="txID" value="<?php ?>" hidden />
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