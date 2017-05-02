<?php

require_once('addToCart.php');
require_once('Cart.class.php');
require_once('common.php');

tryStartSession();
//print_r($_SESSION['cart']);

if(!isLoggedIn()) {
  redirect('login.php');
}

initCart();
$cart = getCart();

?>

<!DOCTYPE html>
<html>
  <head>
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
          <a href="cart_show.php" class="btn btn-default navbar-btn navbar-left"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span id="cartButton" value="6" class="badge"><?php echo $cart->count(); ?></span></a>

          <!-- <button type="button" style="margin-left:10px" class="btn btn-default navbar-btn navbar-right">Sign Out</button> -->
          <a href="logout.php" class="btn btn-default navbar-btn navbar-right">Sign Out</a>
          <p class="navbar-text navbar-right">Signed in as <?php echo getUsername();?>: </p>
        </div>
      </nav>
    </div>

    <div class="container">
      
      <?php require 'products.php'; ?>
    </div>

  </body>

</html>
