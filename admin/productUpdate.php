<?php
  session_start();
  require_once('../common.php');
  require_once('../db.php');

  // No admin session redirect
  if(!isLoggedIn()){
      redirect("../login.php");
  }

  if(!isAdmin()) {
    redirect("../home.php");
  }
?>

<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="productUpdate.js"></script>
  </head>
  <body>

    <div>
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="../home.php">The Shopping Zone</a>
          </div>

          <!-- <button type="button" style="margin-left:10px" class="btn btn-default navbar-btn navbar-right">Sign Out</button> -->
          <a href="../logout.php" class="btn btn-default navbar-btn navbar-right">Sign Out</a>
          <a href="productUpdate.php" class="btn btn-default navbar-btn navbar-right">Admin</a>
          <p class="navbar-text navbar-right">Signed in as <?php echo getUsername();?>: </p>
        </div>
      </nav>
    </div>

    <div id="products" class="container">
      <?php require 'products.php'; ?>
    </div>

    <div id="addForm" class="container" style="display:none;">
      <h2>Add New Item</h2>
      <form class="form-group">
        <label>Item Name</label>
        <input class="form-control" id="name" type="text" name="name"/>
        <label>Description</label>
        <input class="form-control" id="description" type="text" name="description" />
        <label>Price</label>
        <input class="form-control" id="price" type="text" name="cost" />
        <label>Image</label>
        <input class="form-control" id="image" type="text" name="image" />
        <!-- <label>Category</label>
        <select class="form-control" id="category" name="category" > -->
            <?php
              // $categories = getCategories();
              // // Dynamically displaying categories from DB
              // if(($categories != null) && ($categories->rowCount() > 0)){
              //   while($data = $categories->fetch()){
              //     echo "<option>" . $data['type'] . "</option>";
              //   }
              // }
             ?>
        <!-- </select> -->
        <br/>
        <div class="btn-group btn-group-justified">
          <a id="addBack" class="btn btn-danger">Back</a>
          <a id="saveItem" class="btn btn-primary">Add Item</a>
        </div>
      </form>
    </div>

    <div id="editForm" class="container" style="display:none;">
      <h2 id='editH2'></h2>
      <form class="form-group">
        <label>Item Name</label>
        <input class="form-control" id="editName" type="text" name="name"/>
        <label>Description</label>
        <input class="form-control" id="editDescription" type="text" name="description" />
        <label>Price</label>
        <input class="form-control" id="editPrice" type="text" name="cost" />
        <label>Image</label>
        <input class="form-control" id="editImage" type="text" name="image" />
        <!-- <label>Category</label> -->
        <!-- <select class="form-control" id="editCategory" name="category" > -->
            <?php
              // $categories = getCategories();
              // // Dynamically displaying categories from DB
              // if(($categories != null) && ($categories->rowCount() > 0)){
              //   while($data = $categories->fetch()){
              //     if($data['type'] === $category){
              //       echo "<option selected>" . $data['type'] . "</option>";
              //     }
              //     else{
              //       echo "<option>" . $data['type'] . "</option>";
              //     }
              //   }
              // }
             ?>
        <!-- </select> -->
        <input id="editId" type="hidden" name="ID" value="<?php echo $id; ?>" />
        <br/>
        <div class="btn-group btn-group-justified">
          <a id="editBack" class="btn btn-danger">Back</a>
          <a id="saveEdit" class="btn btn-primary">Add Item</a>
        </div>
      </form>
    </div>

  </body>
</html>
