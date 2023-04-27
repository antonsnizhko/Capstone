<?php
require('database.php');
$query = 'SELECT *
          FROM difficulties
          ORDER BY difficultyID';
$statement = $db->prepare($query);
$statement->execute();
$difficulties = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>Add Idea</title>
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
				<li class="active">
					<a href="add.php">Add</a>
				</li>
				<li>
					<a href="sort.php">Sort</a>
				</li>
				<li>
					<a href="about.html">About</a>
				</li>

		</div>
	</div>
	
	<div id="contents">
		<div class="features">
			<div style="display: flex; justify-content:center;">
				<form action="add_idea.php" method="post"
              id="add_idea_form">
			<h1>Add An Idea</h1>
            <label>Difficulty:</label>
            <select name="difficulty_id">
            <?php foreach ($difficulties as $difficulty) : ?>
                <option value="<?php echo $difficulty['difficultyID']; ?>">
                    <?php echo $difficulty['difficultyName']; ?>
                </option>
            <?php endforeach; ?>
            </select><br><br>

            <label>Idea:</label> <br>
            <textarea rows="5" cols="60" name="actual_idea" maxlength="50" style="resize: none" ></textarea>
			<br><br>
			
			<label>Category:</label>
			<select name="category">
				<option value="2">Database</option>
				<option value="1">Game</option>
				<option value="3">Website</option>
				<option value="5">Mobile App</option>
				<option value="4">Math/Calculation</option>
			</select>
			<br><br>
			
			
            <input type="submit" value="Add Idea" style="font-size: 20px; background-color: MediumSeaGreen; width: 100%;"><br><br>
			
			<p><a href="sort.php">View Idea List</a></p>
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