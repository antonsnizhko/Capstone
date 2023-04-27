<?php
require_once('database.php'); 

$randomIdeaQuery = 'SELECT * 
					FROM ideas JOIN difficulties ON ideas.difficultyID = difficulties.difficultyID
					JOIN category ON ideas.categoryID = category.categoryID
					ORDER BY RAND()
					LIMIT 1';
$randomIdeaQuery = $db->prepare($randomIdeaQuery);
$randomIdeaQuery->execute();
$randomIdeaReturned = $randomIdeaQuery->fetch();
$randomIdeaQuery->closeCursor();


if(isset($_POST['generateButton'])) {
	$randomIdeaQuery->execute();
	$randomIdeaReturned = $randomIdeaQuery->fetch();
	$randomIdeaQuery->closeCursor();
}
$title = "";
$randNumb = rand(1,4);
if($randNumb == 1){
	$title = "Brain Blast";
}
else if($randNumb == 2){
	$title = "Think-o-tron";
}
else if($randNumb == 3){
	$title = "Idea-matic";
}
else {
	$title = "Smart Machine";
}

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $title ?></title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<div>
			<div class="logo">
				<img style="width: 50%; height: 100%; padding: 0 0;" src="images/brain logo.png"/>
			</div>
			<ul id="navigation">
				<li class="active">
					<a href="index.php">Home</a>
				</li>
				<li>
					<a href="add.php">Add</a>
				</li>
				<li>
					<a href="sort.php">Sort</a>
				</li>
				<li>
					<a href="about.html">About</a>
				</li>
				<!--
				<li>
					<a href="contact.html">Contact</a>
				</li>
				-->
			</ul>
		</div>
	</div>
	<div id="contents">
		<!--<div id="tagline" class="clearfix">-->
		<div id="" class="features">
			<h1 style="text-align: center ">Click To Generate A Random Idea</h1>
			<div>
				<p class="mainIdea"><?php echo "<b>Idea: </b>" . $randomIdeaReturned['idea'] . "<br/> <b>Category: </b>" . $randomIdeaReturned['categoryName'] . "<br/> <b>Difficulty: </b>" . $randomIdeaReturned['difficultyName'] . "<br/>"; ?></p>
				<form method="post">
					<input class="generateButton" type="submit" name="generateButton" value="Generate new idea" style="width: 100%; height: 40px; font-size: 2em;" />
				</form>
			</div>
		</div>
	</div>
	<div id="footer">
		<div class="clearfix">
			<div id="connect">
				<a href="https://www.facebook.com/anton.snizhko" target="_blank" class="facebook"></a><a href="https://youtu.be/dQw4w9WgXcQ" target="_blank" class="googleplus"></a><a href="https://twitter.com/i/topics/1291673117010534401" target="_blank" class="twitter"></a><a href="https://antonsnizhkoportfolio.000webhostapp.com/" target="_blank" class="tumbler"></a>
			</div>
			<p>
				© 2023 Brain-Blast. All Rights Reserved.
			</p>
		</div>
	</div>
</body>
</html>