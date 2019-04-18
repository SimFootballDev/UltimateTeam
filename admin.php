<?php

include "config.php";
include "user.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// check for admin status
if($isAdmin>0) {
	$msg = "'Sup, <b>" . $_SESSION['username'] . "</b>";
	$forbidden = false;
} else {
	$msg = "Nah fam. You ain't got the credentials.";
	$forbidden = true;
}

if(!$forbidden) {
	
	$actionList = array('edit', 'cash', 'award', 'trade', 'cards', 'ban', 'debug');
		
		if (isset($_GET['action']) && in_array($_GET['action'], $actionList)) {
			
			// process the action (switch function?)
			switch($_GET['action']) {
				
				// load the relevant sub php file, e.g. admin/ad_edit.php
				// and assign to $actionForms for insertion into the document below
		
				case 'edit':
					$actionForms = 'Editing a user... ';
				break;
				
				case 'cash':
					$actionForms = 'Adjusting an account balance...';
				break;
				
				case 'award':
					$actionForms = 'Awarding cards...';
				break;
				
				case 'trade':
					$actionForms = 'Verifying user trades...';
				break;
				
				case 'cards':
					$actionForms = 'Adding a new card...';
				break;
				
				case 'ban':
					$actionForms = 'Managing user bans...';
				break;
		
				// if debug, print a list of all global and session variables, and their values
			
				case 'debug':
					$actionForms = '
						Debug Mode activated!
						<br /><br />
						List of variables goes here...
						';
				break;
				
				default:
					// do nothing
				break;
			}
		}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Control Panel</title>
	<?php include "./scripts.php"; ?>
</head>
<body>
	<div id="main">
		<?php include "./menu.php"; ?>
		<div class="page-header">
			<?php echo $msg ?></b>.
			<a href="dashboard.php" class="return" style="float: right;">Dashboard</a>
			<br /><br />
		</div>
		<!-- do stuff here to:
		     * allow awarding coins or cards
		     * grant/revoke admin access for a specific user
		     * verify trades
            * issue temporary bans 
         -->
		<?php
		if (!$forbidden) {
			echo '<p>The admin buttons below will work properly when I figure out the forms and queries and stuff.<br /> <font style="text-align: right">- 37thchamber</font></p>';
		}
		?>
		<br />
		<a href="?action=edit" class="return" data-toggle="tooltip" title="Grant or revoke admin access for users">Edit User</a> &nbsp; 
		<a href="?action=cash" class="return" data-toggle="tooltip" title="Alter the coin balance of a specific account">Add/Remove Coins</a> &nbsp; 
		<a href="?action=award" class="return" data-toggle="tooltip" title="Add cards to an account">Award Cards</a> &nbsp; 
		<a href="?action=trade" class="return" data-toggle="tooltip" title="Verify pending trades proposed by users">Verify Trades</a> &nbsp; 
		<a href="?action=cards" class="return" data-toggle="tooltip" title="Manage the available cards in the game">Manage Cards</a> &nbsp; 
		<a href="?action=ban" class="return" data-toggle="tooltip" title="Issue or lift bans on users">Manage Bans</a>
		<br /><br /><br />
		<?php echo $actionForms ?>
		<br /><br /><br />
		<p>
			<a href="dashboard.php" class="btn btn-default">Return to the Dashboard</a>
			<a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
		</p>
	</div>
</body>
</html>