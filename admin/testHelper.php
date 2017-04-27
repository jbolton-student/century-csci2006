<?php
  // If Admin privledges available
  // User will have the ability to
  // Add/Update products
  session_start();

  require_once('../common.php');
  require_once('../db.php');
  $name = $cost = $description = $image = $category = "";
  $id=null;
  $done=false;

  // No admin session redirect
  if(is_null($_SESSION['isAdmin'])){
      redirect("../login.php");
  }
  // If user !admin || !logged in redirect to home.php
  if(isset($_SESSION['isAdmin'])){
    if($_SESSION['isAdmin'] === 0)
      redirect("home.php");
  }

  if(isset($_POST['ID'])){
    print_r("post id isset");
    $id = $_POST['ID'];
  }

  print_r($_POST);
  if(isset($_POST['name'])&& isset($_POST['cost']) && isset($_POST['description']) && isset($_POST['image'])&& isset($_POST['category'])){
    if(is_null($_POST['ID']) || $_POST['ID'] == ""){
      $name = $_POST['name'];
      $cost = $_POST['cost'];
      $description = $_POST['description'];
      $image = $_POST['image'];
      $category= $_POST['category'];

      print_r("Attempting to add product to the DB");
      $id = addProduct($_POST['name'],$_POST['cost'],$_POST['description'],$_POST['image'],$_POST['category']);
      if($id != null){
        $done=true;
      }
    }
    else if(!is_null($_POST['ID']) || $_POST['ID'] != ""){
      $id = $_POST['ID'];
      $name = $_POST['name'];
      $cost = $_POST['cost'];
      $description = $_POST['description'];
      $image = $_POST['image'];
      $category= $_POST['category'];

      print_r("Attempting to update DB");
      $id = updateProduct($_POST['ID'],$_POST['name'],$_POST['cost'],$_POST['description'],$_POST['image'],$_POST['category']);
      $done=true;
    }
  }
?>

<html>
<body>
  <h1>
    <?php
      if(isset($_POST['ID'])){
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
  <form role="form" method="POST" action="test.php" id="form">
    <lable>Item Name: <br></lable>
    <input type="text" name="name" value="<?php echo $name; ?>"/>
    <br>
    <lable>Description: <br></lable>
    <input type="text" name="description" value="<?php echo $description; ?>"/>
    <br>
    <lable>Price: <br></lable>
    <input type="text" name="cost" value="<?php echo $cost; ?>"/>
    <br>
    <lable>Image: <br></lable>
    <input type="file" name="image" id="fileToUpload" value="<?php echo $image; ?>"/>
    <br>
    <lable>Category: <br></lable>
    <select name="category" value="<?php echo $category; ?>">
        <?php
          $categories = getCategories();
          // Dynamically displaying categories from DB
          if(($categories != null) && ($categories->rowCount() > 0)){
            while($data = $categories->fetch()){
              echo "<option>" . $data['type'] . "</option>";
            }
          }
         ?>
    </select>
    <input type="hidden" name="ID" value="<?php echo $id; ?>" />
    <input type="submit" value="submit"/>
  </form>

  <?php
    if(done){
      echo "<script>document.getElementById('form').submit()</script>";
    }
  ?>

psuedo code:

update db.php: loginUser()
    update so if table has isAdmin set, then:
        $_SESSION['isAdmin'] = true;


db.php: isAdmin()
    test if $_SESSION['isAdmin'] == true;


//on load
if(! isAdmin()) then:
    redirect("../home.php");

// on submit
if $_POST['id'] exists then:
    display form
    populate form values from item with that ID
else:
    if all form values are not-empty:
        create new table entry
    else:
        print: error, empty values.



</body>
</html>