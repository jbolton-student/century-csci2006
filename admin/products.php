<?php
    require_once('./../db.php');                                 // provides DB conn functions
    // require_once('products.class.php');              // PROBABLY WON'T NEED THIS?!?


    function getSearchTerm() {
        if(isset($_POST['searchStr']))
            return $_POST['searchStr'];
        else
            return "";
    }

    function getAllProducts($pdo) {
        // using classes
        $sql = "select * from products";
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $data = $statement->fetchAll();
        $hitCount = $statement->rowCount();

        if ($hitCount == 0 ) {
            echo("<h3 class=\"loginFail\">No Products Available</h3><br />");
        } else {
            // present data in a table
            echo("<table class='table table-striped table-hover'><tr><th>Product Name</th><th>Price</th><th>Description</th><th>Image</th><th></th></tr>");
            echo("<caption> $hitCount item(s) found: </caption><tbody id='tb'>");

            foreach($data as $i => $row) {
                echo("<tr id='tr".$row[0]."'><td>".$row[2]."</td><td>".$row[1]."</td><td>".$row[4]."</td>");
                // use line below if DB links to external image; following line links to local file in /images/
                echo("<td><img src=\"$row[3]\" alt=\"$row[4]\" height=\"150\" width=\"150\"></td>");
                echo("<td><button id=\"$row[0]\" value='".$row[0]."' class='btn btn-success'>Edit Item</button></td>");
                echo("
                <script>
                  $(document).ready(function(){
                    $('#" . $row[0] . "').click(function(e){
                      e.preventDefault();
                      $('#editH2').text('Edit Item: ".$row['name']."')
                      $('#editId').val('".$row['id']."')
                      $('#editName').val('".$row['name']."')
                      $('#editDescription').val('".$row['description']."')
                      $('#editImage').val('".$row['image']."')
                      $('#editPrice').val('".$row['cost']."')

                      $('#products').hide()
                      $('#editForm').show()
                    });
                  });
                </script></tr>");
                //echo("<img src=\"/project/images/$row[3]\" alt=\"$row[4]\" height=\"160\" width=\"160\"></td></tr>");
            }
            echo("</tbody></table>");
        }
    }

    function listProducts($pdo, $searchValue) {
        // using classes
        $sql = "select * from products where name like :searchValue";
        $searchValue = "%" . $searchValue . "%";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":searchValue", $searchValue);
        $statement->execute();

        $data = $statement->fetchAll();
        $hitCount = $statement->rowCount();

        if ($hitCount == 0 ) {
            echo("<h3 class=\"loginFail\">No products have a name matching the search value!</h3><br />");
        } else {
            // present data in a table
            echo("<table class='table table-striped table-hover'><tr><th>Product Name</th><th>Price</th><th>Description</th><th>Image</th><th></th></tr>");
            echo("<caption> $hitCount item(s) found: </caption><tbody id='tb'>");

            foreach($data as $i => $row) {
                echo("<tr  id='tr".$row[0]."'><td>".$row[2]."</td><td>".$row[1]."</td><td>".$row[4]."</td>");
                // use line below if DB links to external image; following line links to local file in /images/
                echo("<td><img src=\"$row[3]\" alt=\"$row[4]\" height=\"150\" width=\"150\"></td>");
                echo("<td><button id=\"$row[0]\" value='".$row[0]."' class='btn btn-success'>Edit Item</button></td>");
                echo("
                <script>
                  $(document).ready(function(){
                    $('#" . $row[0] . "').click(function(e){
                      e.preventDefault();
                      $('#editH2').text('Edit Item: ".$row['name']."')
                      $('#editId').val('".$row['id']."')
                      $('#editName').val('".$row['name']."')
                      $('#editDescription').val('".$row['description']."')
                      $('#editImage').val('".$row['image']."')
                      $('#editPrice').val('".$row['cost']."')

                      $('#products').hide()
                      $('#editForm').show()
                    });
                  });
                </script></tr>");
                //echo("<img src=\"/project/images/$row[3]\" alt=\"$row[4]\" height=\"160\" width=\"160\"></td></tr>");
            }
            echo("</tbody></table>");
        }
    }

?>


  <h1>Add/Edit Products</h1>
  <hr/>

  <form class="form-group" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
      <label>Enter A Product Keyword:</label>
      <div class="input-group">
        <input class="form-control" type="text" placeholder="Search Products..." name="searchStr" value="<?php echo getSearchTerm(); ?>"/>
        <span class="input-group-btn">
          <button class="btn btn-primary" type="submit">Search</button>
        </span>
      </div>
      <br />
      <button id="addNew" class="btn btn-success">Add New Item</button>
      <br/>
      <?php
          if ( ! empty($_POST["searchStr"]) ) {
              $pdo = DBConnect();                         // connect to the DB
              listProducts($pdo, $_POST["searchStr"]);
          }
          else{
            $pdo = DBConnect();
            getAllProducts($pdo);
          }

          $pdo = null;                                        // free-up DB resources
      ?>

  </form>
