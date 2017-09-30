<!DOCTYPE html>
<html>
<head>
	
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
  <meta charset="utf-8">
    <title>CSGames 2017 Web Player Main Page</title>
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
<!--
<style>
table, th, td {
	
     border: 1px solid white;
    background-color: #808080; 
    color: #ffffff;
}
th, td {
	padding: 10px;
}

</style>
-->	
<style>		
h1 { 
    margin-left: 0.3cm;
}
leftAlignJ {
    margin-left: 0.3cm;
}	
</style>
	
 <?php
  //Create a user session or resume an existing one
 session_start();
 ?>
 
 <?php
if(isset($_SESSION['id'])) {
   // include database connection
    include_once 'config/connection.php'; 
	
	// SELECT query
        $query = "SELECT UID ,username, password FROM user WHERE UID=?";
 
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

    // should take a $_SESSION variable from the search results page, getting the id of the video we clicked on
    $vidid = 1;
    $vid = $con->query("select title,desc,viewCount,likes,dislikes,url from videometa, video where video.id=$vidid and video.id=videometa.id");
		
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
       <li class="active"><a href="#">Home</a></li>
       <li><a href="userProfile.php">Profile</a></li>
       <li><a href="search.php">Search</a></li>
 	    
       
   </ul>
	   <ul class="nav navbar-nav navbar-right">
	   <li class="inactive"><a href="userProfile.php"> <?php echo $myrow['username'];?> </a></li>
	   <li><a href="index.php?logout=1">Log Out</a></li>
     </ul>
   </div>
 </nav>
<br>
<br>
<br>
<div class="page-header">
  <h1 margin-left:5 >Find your next video now!</h1>
</div>

<?php 
// should get the url/title/whatever from the query above, not working
//$url = $vid['url'];
$url = "videos/macbook.mp4";
echo "<h2>".$vid['title']."</h2>";
echo "
<leftAlignJ>
	<video width='600' controls> 
 	   <source margin-left=0.2 src='$url' type='video/mp4'>
		   Your browser does not support the video tag.
	   </video>
<leftAlignJ>"
?>

</body>
</html>