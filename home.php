<?php
session_start();
require('addToCart.php');
require_once('common.php');
//print_r($_SESSION['cart']);

if(!userLoggedIn())
  redirect('login.php');
}

function countCart(){
  if(isset($_SESSION['cart'])){
    if(empty($_SESSION['cart'])){
      echo '0';
    }
    else{
      echo count($_SESSION['cart']);
    }
  }
  else{
    echo '0';
  }
  return;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  </head>
  <body>
    <div>
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="home.php">The Shopping Zone</a>
          </div>

          <p class="navbar-text navbar-left">View Your Cart Items: </p>
          <a href="cart_show.php" class="btn btn-default navbar-btn navbar-left"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge"><?php countCart()?></span></a>

          <!-- <button type="button" style="margin-left:10px" class="btn btn-default navbar-btn navbar-right">Sign Out</button> -->
          <a href="logout.php" class="btn btn-default navbar-btn navbar-right">Sign Out</a>
          <p class="navbar-text navbar-right">Signed in as <?php echo getUsername();?>: </p>
        </div>
      </nav>
    </div>

    <div class="container">
      <h1>All Products</h1>
      <hr/>
      <?php require 'products.php'; ?>
    </div>

  </body>
  <script type="text/javascript" src="script.js"></script>
</html>
