<?php
require_once('database.php');
// Get category ID
if (!isset($difficulty_id)) {
    $difficulty_id = filter_input(INPUT_GET, 'difficulty_id', 
            FILTER_VALIDATE_INT);
    if ($difficulty_id == NULL || $difficulty_id == FALSE) {
        $difficulty_id = 1;
    }
}
if (!isset($category)) {
    $category = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category == NULL || $category == FALSE) {
        $category = '';
    }
}

// Get name for selected difficulty
$queryDifficulty = 'SELECT * FROM difficulties
                      WHERE difficultyID = :difficulty_id';
$statement1 = $db->prepare($queryDifficulty);
$statement1->bindValue(':difficulty_id', $difficulty_id);
$statement1->execute();
$difficulty = $statement1->fetch();
$difficulty_name = $difficulty['difficultyName'];
$statement1->closeCursor();

// Get all difficulties
$queryAllDifficulties = 'SELECT * FROM difficulties
                           ORDER BY difficultyID';
$statement2 = $db->prepare($queryAllDifficulties);
$statement2->execute();
$difficulties = $statement2->fetchAll();
$statement2->closeCursor();

// Get all categories
$selectAllCategories = 'SELECT * FROM category
                           ORDER BY categoryID';
$statement2 = $db->prepare($selectAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get name for selected category
if($category != ''){
	$queryCatt = 'SELECT * FROM category
						  WHERE categoryID = :category_ID';
	$statement5 = $db->prepare($queryCatt);
	$statement5->bindValue(':category_ID', $category);
	$statement5->execute();
	$categoryReturner = $statement5->fetch();
	$category_name = $categoryReturner['categoryName'];
	$statement5->closeCursor();
}

// Get ideas for selected difficulty
if($category != ''){
$queryIdeas = 'SELECT * 
			FROM ideas JOIN category ON ideas.categoryID = category.categoryID
			WHERE difficultyID = :difficulty_id AND ideas.categoryID = :category_id
ORDER BY ideaId';}
else {
	$queryIdeas = 'SELECT * 
			FROM ideas JOIN category ON ideas.categoryID = category.categoryID
			WHERE difficultyID = :difficulty_id
			ORDER BY ideaId';
}
$statement3 = $db->prepare($queryIdeas);
$statement3->bindValue(':difficulty_id', $difficulty_id);
if($category != '')
	$statement3->bindValue(':category_id', $category);
$statement3->execute();
$ideas = $statement3->fetchAll();
$statement3->closeCursor();

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>List of Ideas</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<div>
			<div class="logo">
				<img style="width: 50%; height: 100%; padding: 0 0;" src="images/brain logo.png"/>
			</div>
			<ul id="navigation">
				<li>
					<a href="index.php">Home</a>
				</li>
				<li>
					<a href="add.php">Add</a>
				</li>
				<li class="active">
					<a href="sort.php">Sort</a>
				</li>
				<li>
					<a href="about.html">About</a>
				</li>
				
			</ul>
		</div>
	</div>

	<div id="contents">
		<div class="features">
			<h1 class="title">List of Ideas</h1>
			
			    <aside>
					<h2>Difficulties</h2>
					<nav>
						<ul>
							<?php foreach ($difficulties as $difficulty) : ?>
							<li>
								<a href="sort.php?difficulty_id=<?php echo $difficulty['difficultyID']; ?>">
									<?php echo $difficulty['difficultyName']; ?>
								</a>
							</li>
							<?php endforeach; ?>
						</ul>
					</nav>
					<br><br>
					<h2>Category</h2>
					<nav>
						<ul>
							<?php foreach ($categories as $currCat) : ?>
							<li>
								<a href="sort.php?difficulty_id=<?php echo $difficulty_id . '&category_id=' . $currCat['categoryID'] ?>">
									<?php echo $currCat['categoryName']; ?>
								</a>
							</li>
							<?php endforeach; ?>
						</ul>
					</nav>
				</aside>
				
			<section>
				<h2 class="bruh"><?php echo $difficulty_name; if($category != null) { echo ' ' . $category_name;}?></h2>
				<table class="tb">
					<tr>
						<th>Category</th>
						<th>Idea</th>
						<th>Date Added</th>
					</tr>

					<?php foreach ($ideas as $idea) : ?>
					<tr>
						<td><?php echo $idea['categoryName']; ?></td>
						<td><?php echo $idea['idea']; ?></td>
						<td class="right"><?php echo $idea['dateAdded']; ?></td>
					</tr>
					<?php endforeach; ?>            
				</table>
			</section>
			
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