<?php

if (isset($_POST['s'])) {
	
	echo "Original: " . $_POST['s'];
	echo "<br />Hashed: ";
	echo password_hash($_POST['s'],PASSWORD_DEFAULT);
	echo "<br /><br />";
	echo "You can update the relevant user record with this string to set a new password";
	
} else {
	
	echo '
	<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">
	
		<div class="form-group"  class="form-inline">
			<label>String to Hash</label>
			<input type="text" name="s" class="form-control">
			<input type="submit" class="btn btn-primary" value="Hash It">
		</div>
	
	</form>
	';
	
}

?>
