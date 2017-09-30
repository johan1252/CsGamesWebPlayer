 <?php
  //Create a user session or resume an existing one
 session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
  <meta charset="utf-8">
    <title>CSGames Web Player</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script>
    $(function() {
      $( "#datepicker" ).datepicker();
    });
    </script>
  
</head>
<body>

<style>
h1 {
      font-size: 30px;
      color: #303030;
      font-weight: 600;
      margin-bottom: 30px;
  }

</style>  
  

 
 <?php
if(isset($_SESSION['id'])) {
   // include database connection
    include_once 'config/connection.php'; 
  
  // SELECT query
        $query = "SELECT password, username, bio, picFile FROM user WHERE UID=?";
 
        // prepare query for execution
        $stmt = $con->prepare($query);
    
        // bind the parameters. This is the best way to prevent SQL injection hacks.
        $stmt->bind_Param("s", $_SESSION['id']);

        // Execute the query
    $stmt->execute();
 
    // results 
    $result = $stmt->get_result();
    
    // Row data
    $myrow = $result->fetch_assoc();
    
} else {
  //User is not logged in. Redirect the browser to the login index.php page and kill this page.
  header("Location: index.php");
  echo "Not logged in";
  die();
}
?>

 <nav class="navbar navbar-inverse navbar-fixed-top">
   <div class="container-fluid">
     <div class="navbar-header">
       <a class="navbar-brand" href="index.php">CSGames</a>
     </div>
     <ul class="nav navbar-nav">
       <li><a href="gen_main.php">Home</a></li>
       <li class="active"><a href="#">Profile</a></li>
	   <li><a href="search.php">Search</a></li>
       
   </ul>
	   <ul class="nav navbar-nav navbar-right">
	   <li class="active"><a href="userProfile.php"> <?php echo $myrow['username'];?> </a></li>
	   <li><a href="index.php?logout=1">Log Out</a></li>
     </ul>
   </div>
 </nav>
<br>

<br>
<br>
  <h1 style = "margin-left: 10px;">Welcome <?php echo $myrow['username'];?>,</h1>

<?php
 
if(isset($_POST['updateBtn']) && isset($_SESSION['id'])){
    // include database connection
    include_once 'config/connection.php'; 

    $query = "UPDATE user SET bio=?, password=? WHERE UID=?";

    $stmt = $con->prepare($query); 
     $stmt->bind_param('sss', $_POST['bio'], $_POST['password'], $_SESSION['id']);
    // Execute the query
          $stmt->execute();
            
         
     Header("Location: userProfile.php");
  }

?>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<form name='login' id='login' action='userProfile.php' method='post'>
    <div class="row">
        <div style = "margin-left: 10px;" class="col-md-3">
            <div class="form-login">
                        <label for="username">Username:</label>

            <input disabled type="text" name='username' id='username' class="form-control input-sm chat-input" value="<?php echo $myrow['username']; ?>"/>
                        <label for="password">Password:</label>

            <input type="password" name='password' id='password' class="form-control input-sm chat-input" value="<?php echo $myrow['password']; ?>" />
                        <label for="bio">Bio:</label>

            <input type="text" name='bio' id='bio' class="form-control input-sm chat-input" value="<?php echo $myrow['bio']; ?>" />
            </br>
            <div class="wrapper">
            <span class="group-btn">     
                <input type='submit' id='updateBtn' name='updateBtn' value='Update' class="btn btn-primary btn-md" />
				<br>
				<br>
				<br>
				<br>
				<input type='submit' id='delete_Btn' name='delete_Btn' value='Delete Account' class="btn btn-danger btn-md" />
			    
            </span>
            </div>
            </div>
        
    </div>
</div>
</form>
<h3>Upload a new user image</h3>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select new user image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
	<br>
    <input type="submit" value="Upload Image" name="submit">
</form>
				<?php
 
				 if(isset($_SESSION['id'])){
				  // include database connection
				    include_once 'config/connection.php';
			 	if(isset($_POST['delete_Btn'])) { // 'Delete' has been clicked but not confirmed
			 		?>
			 		<form class="form-inline" action='userProfile.php' method=POST>
			 		<label for="confirm_delete_btn">Are you sure you want to delete your account forever?</label>
			 		<a href="userProfile.php" class="btn btn-default" role="button">Cancel</a>
			 		<input class="btn btn-danger"  name='confirm_delete_btn' id='confirm_delete_btn' value="Delete" type="submit">
			 		</form>
			 		<?php
				}
				
			}
					?>

</body>
</html>