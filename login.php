<?php

require_once('db.php');
require_once('common.php');

tryStartSession();

$error = false;
$message = '';
if (isset($_POST['email']) && isset($_POST['password'])){
  loginUser();
}
if(isset($_POST['registerEmail']) && isset($_POST['registerPassword']) && isset($_POST['confirmPassword'])){
  $message = registerUser();
}

if(isLoggedIn()) {
    redirect("home.php");
} else {
    if(isset($_POST['email'])
        || isset($_POST['password'])
    ) {
        $error = true;
    }
}

// otherwise show login form

?>

<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  </head>
  <body>

    <div id="login" class="container">
      <br/>
      <div style="background-color:lightgrey; padding:10px; border-radius: 10px; box-shadow: 10px 10px 5px #888888;" class="col-sm-6 col-sm-offset-3">
        <h1> Login </h1>
        <hr/>
        <?php if($error) echo "<p style='color:red;'>Error: Bad email or password</p>";
              if($message == "Successful Registration: You Can Now Login") echo "<p style='color:green;'>" .$message. "</p>";
              if($message == "Failed To Register: Please Try Again") echo "<p style='color:red;'>" .$message. "</p>";
        ?>
        <form id="loginForm" class="form-group" method="post" action="login.php">
          <label>Email</label>
          <input class="form-control" type="text" name="email" placeholder="Email...">
          <br/>
          <label>Password</label>
          <input class="form-control" type="password" name="password" placeholder="Password...">
          <br/>
          <div class="btn-group btn-group-justified">
            <a id="regButton" class="btn btn-warning">Register</a>
            <a id="loginButton" class="btn btn-primary">Log In</a>
          </div>
        </form>
      </div>
    </div>

    <div id="register" class="container" style="display:none;">
      <br/>
      <div style="background-color:lightgrey; padding:10px; border-radius: 10px; box-shadow: 10px 10px 5px #888888;" class="col-sm-6 col-sm-offset-3">
        <h1> Register </h1>
        <hr/>
        <form id="registerForm" class="form-group" method="post" action="login.php">
          <label>Email</label>
          <input class="form-control" type="text" name="registerEmail" placeholder="Email...">
          <br/>
          <label>Password</label>
          <input class="form-control" type="password" name="registerPassword" placeholder="Password...">
          <br/>
          <label>Confirm Password</label>
          <input class="form-control" type="password" name="confirmPassword" placeholder="Confirm Password...">
          <br/>
          <div class="btn-group btn-group-justified">
            <a id="back" class="btn btn-danger">Back</a>
            <a id="confirmButton" class="btn btn-primary">Confirm</a>
          </div>
        </form>
      </div>
    </div>

    <script src='login.js'></script>
  </body>
</html>
