<?php
  require_once('./../db.php');

  if(isset($_POST['name'])&& isset($_POST['cost']) && isset($_POST['description']) && isset($_POST['image'])){
    if(!isset($_POST['ID'])){  
      echo json_encode(addProduct($_POST['name'],$_POST['cost'],$_POST['description'],$_POST['image']));
    }
    else{
      echo json_encode(updateProduct($_POST['ID'],$_POST['name'],$_POST['cost'],$_POST['description'],$_POST['image']));
    }
  }
?>
