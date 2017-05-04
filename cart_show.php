<?php

require_once('common.php');
require_once('Cart.class.php');
require_once('Products.class.php');

tryStartSession();

if(!isLoggedIn()) {
  redirect('login.php');
}

initCart();

function getAllProducts() {
    $cart = getCart();
    $productCount = $cart->count();
    $count = 0;

    if($productCount == 0) {
        echo("<h3>Empty Cart</h3>");
        return;
    }

    echo("<script type='text/javascript' src='cart.js'></script>");
    echo("<script type='text/javascript'>addListeners('$productCount');</script>");

    echo("<script>var buttons=0;</script>");
    echo("<table class='table table-striped table-hover'><tr><th>Product Name</th><th>Price</th><th>Description</th><th>Image</th><th></th></tr>");
    echo("<caption> $productCount item(s) found: </caption>");

    foreach($cart->getItems() as $item) {
        // echo("I: " . $item->getName());
        $id = $item->getId();
        $name = $item->getName();
        $cost = $item->getCost();
        $description = $item->getDescription();
        $image = $item->getImage();
        $count += 1;


        echo("<tr><td>".$name."</td><td>".$cost."</td><td>".$description."</td>");
            // use line below if DB links to external image; following line links to local file in /images/
            echo("<td><img src=\"$image\" alt=\"$name\" height=\"150\" width=\"150\"></td>");
            // echo("<td><button class='btn btn-success' id='removeFromCart" .$id. "' value='".$id."' class='btn btn-success'>Remove From Cart</button></td></tr>");
            echo("<td><button class='btn btn-danger' id='removeButton$count' value='$id.' class='btn btn-success'>Remove From Cart</button></td></tr>");
    }
    echo("</table>");
    echo("<script></script>");
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>show cart</title>
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
      <h1>Your Cart</h1>
      <a href="purchase.php" class="btn btn-success pull-right">Purchase Items</a>
      <hr/><?php getAllProducts(); ?>
    </div>

  </body>
</html>
