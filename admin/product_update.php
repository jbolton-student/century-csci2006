<?php
// If Admin privledges available
// User will have the ability to
// Add/Update products
session_start();

require_once('common.php');
require_once('db.php');
// If user !admin || !logged in redirect to home.php
  if(isset($_SESSION['isAdmin'])){
    if($_SESSION['isAdmin'] === 0)
      redirect("home.php");
  }

?>

<html>
<body>
  <h1>Home</h1>
  <p>user: <b>
  <?php
      echo getUsername();
  ?>
  </b></p>
  <p>Form here: for all fields of table products.</p>
  <form role="form" method="POST" action="#" name="editProduct">
    <lable>Description: <br></lable>
    <input type="text" name="description"/>
    <br>
    <lable>Price: <br></lable>
    <input type="text" name="price"/>
    <br>
    <lable>Image: <br></lable>
    <input type="file" name="fileToUpload" id="fileToUpload"/>
    <br>
    <select name="Category">
        <?php
          $catergories = getCatergories();
          // Dynamically displaying catergories from DB
          if(($catergories != null) && ($catergories->rowCount() > 0)){
            while($data = $catergories->fetch()){
              echo "<option>" . $data['type'] . "</option>";
            }
          }
         ?>
      <input type="submit" value="submit"/>
     </form>

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
