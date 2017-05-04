<?php
  require_once('./../db.php');

  if(isset($_POST['name'])&& isset($_POST['cost']) && isset($_POST['description']) && isset($_POST['image'])){
    if(!isset($_POST['ID'])){
      // $name = $_POST['name'];
      // $cost = $_POST['cost'];
      // $description = $_POST['description'];
      // $image = $_POST['image'];
      //$category= $_POST['category'];
      //addProduct($_POST['name'],$_POST['cost'],$_POST['description'],$_POST['image'],$_POST['category']);
      echo json_encode(addProduct($_POST['name'],$_POST['cost'],$_POST['description'],$_POST['image']));
    }
    else{
      // $id = $_POST['ID'];
      // $name = $_POST['name'];
      // $cost = $_POST['cost'];
      // $description = $_POST['description'];
      // $image = $_POST['image'];
      // $category= $_POST['category'];

      //$id = updateProduct($_POST['ID'],$_POST['name'],$_POST['cost'],$_POST['description'],$_POST['image'],$_POST['category']);
      echo json_encode(updateProduct($_POST['ID'],$_POST['name'],$_POST['cost'],$_POST['description'],$_POST['image']));
    }
  }
?>
