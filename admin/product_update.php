<?php
session_start();

require_once('common.php');
require_once('db.php');

?>

<html><body>
<h1>Home</h1>
<p>user: <b>
<?php
    echo getUsername();
?>
</b></p>


<p>Form here: for all fields of table products.</p>

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



</body></html>