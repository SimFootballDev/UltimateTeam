<?php

// Initialize the session
//session_start();

include "config.php"; 
include "user.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// reset error flag
$fatalError = 0;

// if the logged in user doesnt have an account, create one
$result = mysqli_query($link,"SELECT * FROM accounts WHERE userID = " . $_SESSION["id"]);

if (!is_null($result)) {
	$acctRows = mysqli_num_rows($result);
} else {
	$acctRows = 0;
}

if ($acctRows == 0 || is_null($acctRows)) {
	
	$sql = "INSERT INTO `accounts` (`userID`, `acctBalance` ) VALUES (" . $_SESSION["id"] . "," . 25 . ")";
	
	if (mysqli_query($link, $sql)) {
		
		$status = "Account successfully created!\n\nYou have been awarded 25 coins as a starting gift.";
		
	} else {
	
		$status = "There was an error retrieving your account information. Contact 37thchamber.";
		$fatalError = 1;
		
	}
	
} else {
	
	// get account info to array
	$acctInfo = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
	// use query result in case it has changed since session start (?)
	$status = "Your current balance is " . $acctInfo["acctBalance"] . " coins.";
	
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
	<?php include "./scripts.php"; ?>
</head>
<body>
	<div id="main">
		<?php include "./menu.php"; ?>
		<div class="page-header">
			<div id="greeting">
				Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.
				<br /><br /><?php echo htmlspecialchars($status); ?>
			</div>
		</div>
		<?php 
			if($fatalError===0) {
			echo '
         			<!-- only print this part if there is no error retrieving account info -->
					<p>
						<a href="collection.php" class="btn btn-primary">View Your Collection</a>
						<a href="buy.php" class="btn btn-primary">Buy Packs</a>
					</p>
				 ';
			}
			
		?>
		<p>
			<a href="reset.php" class="btn btn-warning">Reset Your Password</a>
			<a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
		</p>
	</div>
</body>
</html>