<?php
  if(isset($_POST['addToCart'])){
    //array_push($_SESSION['cart'],$_POST['addToCart']);
    print_r('poopooopoopoop');
    $_SESSION['cart'] = $_POST['addToCart'];
  }
?>
