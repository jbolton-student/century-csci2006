<?php
	session_start();

	require_once('db.php');									// provides DB conn functions


	function getSearchTerm() {
        if(isset($_POST['searchStr']))
            return $_POST['searchStr'];
        else
            return "";
    }

	// This function displays the products of the database in a table
	//
	function listProducts($pdo, $searchValue, $ordering) {
		// DEBUG code // echo("search = $searchValue, order = $ordering<br />");

		 // set value of $sql based on select choice which drives ordering
		 switch ($ordering) {
			case "1":
				$sql = "select * from products where name like :searchValue ORDER BY name ASC";
				break;
			case "2":
				$sql = "select * from products where name like :searchValue ORDER BY cost ASC";
				break;
			default:
				echo("<h3 class=\"loginFail\">An incorrect value has been provided to the switch in listProducts() </h3>");
		 }

		 $searchValue = "%" . $searchValue . "%";
		 $statement = $pdo->prepare($sql);
		 $statement->bindValue(":searchValue", $searchValue);
		 $statement->execute();

		 $data = $statement->fetchAll();
		 $hitCount = $statement->rowCount();

		 if ($hitCount == 0 ) {
			  echo("<h3 class=\"loginFail\">No products have a name matching the search value!</h3><br />");
		 }
		 else {
			 // present data in a table
			 echo("<table><tr><th>Product Name</th><th>Price</th><th>Description</th><th>Image</th><th>Add to Cart</th></tr>");
			 echo("<caption> $hitCount item(s) found: </caption>");
			 foreach($data as $i => $row) {
				 echo("<tr><td>".$row[2]."</td><td>".$row[1]."</td><td>".$row[4]."</td>");
				 echo("<td>" . addImageWithLink($row[3], $row[4], $row[0]) . "</td>");
				 echo("<td>" . addCartIcon($row[0]) . "</td></tr>");
			}
			 echo("</table>");

		 }
}

function addImageWithLink($imgName, $altText, $prodId) {
	// the following line is for the "public version" of this code
	//echo("<td><img src=\"$row[3]\" alt=\"$row[4]\" height=\"160\" width=\"160\"></td><td>".$row[0]."</td></tr>");
	$myReturn = "<a href=\"product_show.php?id=$prodId\"><img src=\"$imgName\" alt=\"$altText\" height=\"160\" width=\"160\"></a>";

	// the line below links to images on my PC, not external images
	// DEBUG // $myReturn = "<a href=\"product_show.php?id=$prodId\"><img src=\"/project/images/$imgName\" alt=\"$altText\" height=\"160\" width=\"160\"></a>";
	return $myReturn;
}

function addCartIcon($prodId) {
	$filepath = "images/addToCart.png";

	$myReturn = "<a href=\"cart_add.php?id=$prodId\"><img src=\"$filepath\" /></a>";
	return $myReturn;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
	<title>Product Search</title>
	<!-- Custom styles for this template -->
   <link href="project_search.css" rel="stylesheet">
</head>

<body>
	<h2>Product Search</h2>
	<hr />
	<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<h3>Enter a product name or part of a name:</h3>
		<input type="text" name="searchStr" value="<?php echo getSearchTerm(); ?>"/>
		<button type="submit">Search</button>
		<br />
		<select name="orderTbl">
			<option value="1">Order by product name</option>
			<?php
				// this code sets the second select item as the displayed item if it was selected
				// in the previous, submitted state of the form
				//
				if ($_POST['orderTbl'] == 2) {
					echo("<option value=\"2\" selected=\"selected\">Order by product price</option>");
				}
				else {
					echo("<option value=\"2\">Order by product price</option>");
				}
			?>
		</select>
		<?php
			if ( ! empty($_POST['searchStr']) ) {		// display records matching searchStr
				$pdo = DBConnect();							// connect to the DB
				listProducts($pdo, $_POST['searchStr'], $_POST['orderTbl']);
			}
			else {												// display all records
				$pdo = DBConnect();							// connect to the DB
				listProducts($pdo, "", "1", 0);
			}

			$pdo = null;										// free-up DB resources
		?>
</body>
</html>
