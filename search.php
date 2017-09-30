<!DOCTYPE html>
<head>
	<title>Search Results</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
  <meta charset="utf-8">
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

 <nav class="navbar navbar-inverse navbar-fixed-top">
   <div class="container-fluid">
     <div class="navbar-header">
       <a class="navbar-brand" href="index.php">CSGames</a>
     </div>
     <ul class="nav navbar-nav">
       <li><a href="gen_main.php">Home</a></li>
       <li><a href="userProfile.php">Profile</a></li>
       <li class="active"><a href="search.php">Search</a></li>
 	    
       
   </ul>
	   <ul class="nav navbar-nav navbar-right">
	   <li><a href="index.php?logout=1">Log Out</a></li>
     </ul>
   </div>
 </nav>
<br>
<br>
<br>

	<h3>Search Results</h3>
<form action="search.php" method="post">
	<input class="button" type="submit" name="order" value="Order Descending Views">
	<input type="text" name="minimum" value="">
	<input class="button" type="submit" name="min" value="Min View Count">
</form>
	<?php

	session_start();
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	try {
		$dbh = new PDO('mysql:host=localhost;dbname=videoPlayer', 'root', '');
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// supposed to take the search input from the search text input from the other page in $_SESSION
		// whether you're searching by tags, description, or title should be specified
		$searchSpec = " "; // should hold what we're searching against
		$str = "%technology%"; // variable that holds the search string

		/*if ($searchSpec == "tags"){
			echo "tag";
		}
		else if ($searchSpec == "descr"){
			echo "descr";
		}
		else { // Title
			echo "title";
		}*/
		echo "<br>";
		$vidSearch = $dbh->query("select title, thumb, viewCount, username
from video, upload, user, videometa where (video.tags like '$str') AND video.vid=upload.VID and user.UID=upload.UID");
		
		if(isset($_POST['order'])){ // sort by descending view count
			$vidSearch = $dbh->query("select title, thumb, viewCount, username
from video, upload, user, videometa where (video.tags like '$str') AND video.vid=upload.VID and user.UID=upload.UID order by viewCount desc");
		}
		if(isset($_POST['min'])){ // filter out based on min required views
			$count = $_POST['minimum'];
			$vidSearch = $dbh->query("select title, thumb, viewCount, username
from video, upload, user, videometa where (video.tags like '$str') AND video.vid=upload.VID and user.UID=upload.UID and viewCount > $count");
		}

		echo "<table align='center'><tr><th></th><th>Title</th><th>Uploader</th><th>View Count</th></tr>";
		foreach($vidSearch as $vid){
			echo "<tr><td><img width=100px src=".$vid['thumb']." alt='no thumbnail'></td>";
			$title = $vid['title'];
			echo "<td><a src='gen_main.php'>$title</a></td>";
			echo "<td>".$vid["username"]."</td>";
			echo "<td>".$vid["viewCount"]."</td></tr>";
		}
		echo "</table>";
	}
	catch (PDOException $e){
			echo $e->getMessage();
			echo "Error: cannot connect to database";
	}
	$dbh = null;
	?>

</body>

</html>