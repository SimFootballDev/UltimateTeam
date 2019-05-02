		<div id="header-row">
			<ul>
				<li><a href="<?php echo $appRoot; ?>logout.php" class="logout">Logout</a></li>
				<?php if($_SESSION["isAdmin"]>0) { echo '<li><a href="admin.php" class="admin">Admin</a></li>'; } ?>
				<li>Coins: <?php echo htmlspecialchars($_SESSION["acctCash"]); ?></li>
				<li>User: <?php echo htmlspecialchars($_SESSION["username"]); ?> &nbsp; (ID: <?php echo sprintf('%03d',htmlspecialchars($_SESSION["acctID"])); ?>)&nbsp;&nbsp;&nbsp;&bull;&nbsp;</li>
			</ul>
		</div>