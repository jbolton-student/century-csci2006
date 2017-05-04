<?php
  // If Admin privledges available
  // User will have the ability to
  // Add/Update products
  session_start();
  require_once('../common.php');
  require_once('../db.php');

  $name = $cost = $description = $image = $category = "";
  $id=null;

  // No admin session redirect
if(!isLoggedIn()){
    redirect("../login.php");
}

if(!isAdmin()) {
  redirect("../home.php");
}

  if(isset($_POST['ID'])){
    if(!is_null($_POST['ID'])){
      $id = $_POST['ID'];
    }
  }
  print_r($_POST);
  if(isset($_POST['name'])&& isset($_POST['cost']) && isset($_POST['description']) && isset($_POST['image'])&& isset($_POST['category'])){
      $name = $_POST['name'];
      $cost = $_POST['cost'];
      $description = $_POST['description'];
      $image = $_POST['image'];
      $category= $_POST['category'];
    }
?>

<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="productUpdate.js"></script>
  </head>
  <body>
    <div class="container">
      <h1>
        <?php
          if(isset($_POST['ID']) && $_POST['ID'] != ""){
              echo "Edit Product: $name";
          }
          else{
              echo "Add New Product: ";
          }
        ?>
      </h1>
      <p>user: <b>
        <?php
            echo getUsername();
        ?>
      </b></p>
      <!-- <p>Form here: for all fields of table products.</p> -->
      <form>
        <lable>Item Name: <br></lable>
        <input id="name" type="text" name="name"/>
        <br>
        <lable>Description: <br></lable>
        <input type="text" name="description" value="<?php echo $description; ?>"/>
        <br>
        <lable>Price: <br></lable>
        <input type="text" name="cost" value="<?php echo $cost; ?>"/>
        <br>
        <lable>Image: <br></lable>
        <input type="text" name="image" id="fileToUpload" value="<?php echo $image; ?>"/>
        <br>
        <lable>Category: <br></lable>
        <select name="category" id="select">
            <?php
              $categories = getCategories();
              // Dynamically displaying categories from DB
              if(($categories != null) && ($categories->rowCount() > 0)){
                while($data = $categories->fetch()){
                  if($data['type'] === $category){
                    echo "<option selected>" . $data['type'] . "</option>";
                  }
                  else{
                    echo "<option>" . $data['type'] . "</option>";
                  }
                }
                //echo "<script>document.getElementById('select').value=". $category . "</script>";
              }
             ?>
        </select>
        <input type="hidden" name="ID" value="<?php echo $id; ?>" />

      </form>
      <button id="productUpdate">Submit</button>
    </div>

  </body>
</html>
