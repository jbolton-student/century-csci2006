<?php
	// purchase.php
	
	require_once('header.inc.php');
	require_once('db.php');
	require_once('common.php');
	require_once('cart.class.php');

	tryStartSession();
	
	
	$cart = getCart();
   $productCount = $cart->count();
	?>
<html>
<head>
	<title> Check-out </title>
</head>

<body>

	<?php
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			echo("<h3>Your order has been placed</h3><br />");
			$cart->clear();
		}
		else {
			if($productCount == 0) {
				echo("<h3>You have no products in your shopping cart!</h3>");
				// do something else here -- what?!
			 }
			 else {
				// display sub-total of shopping cart
				echo("<h3>Your shopping cart price: " . $cart->getSubtotal() . "</h3><br />");
		?>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<button type="submit"> Buy </button>
					<!-- clicking the button will "purchase the items" and clear the shopping cart -->
				</form>
	<?php
		    }	
		 }
	?>

	</form>
</body>
</html>
