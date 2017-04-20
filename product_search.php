<?php
    session_start();                // TO-DO:  USE THIS INFO, SOMEHOW/SOMEWAY!!!

    require_once('db.php');                                 // provides DB conn functions
    // require_once('products.class.php');              // PROBABLY WON'T NEED THIS?!?


    function getSearchTerm() {
        if(isset($_POST['searchStr']))
            return $_POST['searchStr'];
        else
            return "";
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
            echo("<table><tr><th>Product Name</th><th>Price</th><th>Description</th><th>Image</th></tr>");
            echo("<caption> $hitCount item(s) found: </caption>");

            foreach($data as $i => $row) {
                echo("<tr><td>".$row[2]."</td><td>".$row[1]."</td><td>".$row[4]."</td><td>");
                // use line below if DB links to external image; following line links to local file in /images/
                echo("<img src=\"$row[3]\" alt=\"$row[4]\" height=\"160\" width=\"160\"></td></tr>");
                //echo("<img src=\"/project/images/$row[3]\" alt=\"$row[4]\" height=\"160\" width=\"160\"></td></tr>");
            }
            echo("</table>");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
    <title>Product Search</title>
    <!-- Custom styles for this template -->
   <link href="css/project_search.css" rel="stylesheet">
</head>

<body>
    <h2>Product Search</h2>
    <hr />
    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <h3>Enter a product name or part of a name:</h3>
        <input type="text" name="searchStr" value="<?php echo getSearchTerm(); ?>"/>
        <button type="submit">Search</button>
        <br />
        <?php
            if ( ! empty($_POST['searchStr']) ) {
                $pdo = DBConnect();                         // connect to the DB
                listProducts($pdo, $_POST['searchStr']);
            }

            $pdo = null;                                        // free-up DB resources
        ?>
</body>
</html>
