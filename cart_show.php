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

    if($productCount == 0) {
        echo("<h3>Empty Cart</h3>");
        return;
    }

    echo("<table class='table table-striped table-hover'><tr><th>Product Name</th><th>Price</th><th>Description</th><th>Image</th><th></th></tr>");
    echo("<caption> $productCount item(s) found: </caption>");
    
    foreach($cart->getItems() as $item) {
        // echo("I: " . $item->getName());
        $id = $item->getId();
        $name = $item->getName();
        $cost = $item->getCost();
        $description = $item->getDescription();
        $image = $item->getImage();


        echo("<tr><td>".$name."</td><td>".$cost."</td><td>".$description."</td>");
            // use line below if DB links to external image; following line links to local file in /images/
            echo("<td><img src=\"$image\" alt=\"$name\" height=\"150\" width=\"150\"></td>");
            echo("<td><button id='removeFromCart' value='".$id."' class='btn btn-success'>Remove From Cart</button></td></tr>");
            //echo("<img src=\"/project/images/$row[3]\" alt=\"$row[4]\" height=\"160\" width=\"160\"></td></tr>");
    }
    echo("</table>");
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>show cart</title>
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
          <a href="cart_show.php" class="btn btn-default navbar-btn navbar-left"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge"><?php echo getCart()->count(); ?></span></a>

          <!-- <button type="button" style="margin-left:10px" class="btn btn-default navbar-btn navbar-right">Sign Out</button> -->
          <a href="logout.php" class="btn btn-default navbar-btn navbar-right">Sign Out</a>
          <p class="navbar-text navbar-right">Signed in as <?php echo getUsername();?>: </p>
        </div>
      </nav>
    </div>

    <div class="container">
      <h1>All Products</h1>
      <hr/><?php getAllProducts(); ?>
    </div>

  </body>
  <script type="text/javascript" src="script.js"></script>
</html>
