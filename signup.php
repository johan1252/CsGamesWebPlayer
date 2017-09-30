 <?php
  //Create a user session or resume an existing one
 session_start();
 ?>

<?php

 
//check if the login form has been submitted
if(isset($_POST['signUpBtn'])){
include_once 'config/connection.php'; 

    $query = "SELECT * FROM user WHERE username=?";
        // prepare query for execution
      if($stmt = $con->prepare($query)){
      $stmt->bind_Param("s", $_POST['username']);
      // bind the parameters. This is the best way to prevent SQL injection hacks.
   
      // Execute the query
      $stmt->execute();
 
      /* resultset */
      $result = $stmt->get_result();

      // Get the number of rows returned
      $num = $result->num_rows;
      if($num>0){
     
        $message = "This username has already been taken";
        echo "<script type='text/javascript'>alert('$message');</script>";     
      } 
      else 
      {
        
        $query = "INSERT into user values(null, ?,?, null, null)";
          $stmt = $con->prepare($query);
          $stmt->bind_Param("ss", $_POST['username'],$_POST['password']);
          $stmt->execute();

        

        header("Location: login.php");
        
      }
    }  
    
    else {
      echo "failed to prepare the SQL";
    }
 
}                     
?>


<!DOCTYPE HTML>
<html>
    <head>
        <title>CS Games Web Player</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  		<style>
  body {
      font: 400 15px Lato, sans-serif;
      line-height: 1.8;
      color: #818181;
  }
  h2 {
      font-size: 24px;
      text-transform: uppercase;
      color: #303030;
      font-weight: 600;
      margin-bottom: 30px;
  }
  h4 {
      font-size: 15px;
      line-height: 1.375em;
      color: #303030;
      font-weight: 400;
      margin-bottom: 30px;
      padding-top: 70px; 
      padding-bottom: 0px; 

  }  
 
  .navbar {
      margin-bottom: 0;
      background-color: #FFFFFF;
      z-index: 9999;
      border: 0;
      font-size: 12px !important;
      line-height: 1.42857143 !important;
      letter-spacing: 4px;
      border-radius: 0;
      font-family: Montserrat, sans-serif;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #f4511e !important;
      background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #fff !important;
  }

  </style>
    </head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
		<a href="index.php">
    <img src="CS17_logo.png" style="width:70px;height:60px;">
</a>                   
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        
      </ul>
    </div>
  </div>
</nav>


<!--Pulling Awesome Font -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<form name='signupp' id='signupp' action = 'signup.php' method='post'>
<div class="container">
    <div class="row">
           <div class="col-md-offset-0.5 col-md-3"> 
          <h4>Please enter the following information to create an account.</h4>
            <div class="form-login">
            <label for="username">Username:</label>
            <input required type="text" name='username' id='username' class="form-control input-sm chat-input" placeholder="Username" />
            <label for="password">Password:</label>
            <input required type="password" name='password' id='password' class="form-control input-sm chat-input" placeholder="Password" />
			<br>
            <div class="form-group">
            <div class="wrapper">
            <span class="group-btn">     
            <input type='submit' id='signUpBtn' name='signUpBtn' value='Sign Up' class="btn btn-primary btn-md" />
            </span>
            </div>
			<a href="index.php"><br><br><br>Press here to go back to homepage.</a>
            </div>
        </div>
    </div>
</div>
</form>


</body>
</html>