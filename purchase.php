<?php
	// purchase.php

	require_once('common.php');
	require_once('Cart.class.php');
	require_once('Products.class.php');

	tryStartSession();

	function checkOut() {
		initCart();
		$cart = getCart();

		$prodCt = $cart->count();
	
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			echo("<h3>Your order has been placed</h3><br />");
			$cart->clear();
		}
		else {
			if($prodCt == 0) {
				echo("<h3>You have no products in your shopping cart!</h3>");
			 }
			 else {
				// display sub-total of shopping cart
				echo("<h3>Your shopping cart price: " . $cart->getSubtotal() . "</h3><br />");

				echo("<form method=\"post\" action=" . $_SERVER['PHP_SELF'] . ">");
					echo("<button type=\"submit\"> Buy </button>");
					// clicking the button will "purchase the items" and clear the shopping cart
				echo("</form>");

		    }
		 }
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Check Out</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
  </head>
  <body>
    <div>
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="home.php">The Shopping Zone</a>
          </div>

          <p class="navbar-text navbar-left">View Your Cart Items: </p>
          <a href="cart_show.php" class="btn btn-default navbar-btn navbar-left"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span id="cartButton" class="badge"><?php echo getCart()->count(); ?></span></a>

          <!-- <button type="button" style="margin-left:10px" class="btn btn-default navbar-btn navbar-right">Sign Out</button> -->
          <a href="logout.php" class="btn btn-default navbar-btn navbar-right">Sign Out</a>
          <?php if(isAdmin()) { echo"<a href='admin/productUpdate.php' class='btn btn-default navbar-btn navbar-right'>Admin</a>";
          }
          ?>
          <p class="navbar-text navbar-right">Signed in as <?php echo getUsername();?>: </p>
        </div>
      </nav>
    </div>

    <div class="container">
      <h1>Check Out</h1>
      <hr/><?php checkOut(); ?>
    </div>

  </body>
</html>

	
