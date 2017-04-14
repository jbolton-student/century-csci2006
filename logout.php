<?php
	session_start();
	$currentUser = $_SESSION['valid_user'];
	unset($_SESSION['valid_user']);

	session_destroy();

?>

<html>
<body>
	<h1> Log out </h1>

	<?php
		if (!empty($currentUser))
		{

			echo "Logged out <br>";
		}
		else
		{
			echo "Never logged in! Can't log you out ...<br>";

		}
	?>
	<a href="login.php"> Back to login page </a>
</body>
</htm>
