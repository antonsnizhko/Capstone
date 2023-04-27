<?php
// Get the ideas
$difficulty_id = filter_input(INPUT_POST, 'difficulty_id', FILTER_VALIDATE_INT);
$idea = filter_input(INPUT_POST, 'actual_idea');
$category = filter_input(INPUT_POST, 'category');

// Validate inputs
if ($difficulty_id == null || $difficulty_id == false ||
        $idea == null || empty($idea) || $category == null || empty($category) ) {
    $error = "Invalid input data. Check all fields and try again.";
    include('database_error.php');
} else {
    require_once('database.php');

    // Add the idea to the database  
    $query = 'INSERT INTO ideas
                 (difficultyID, idea, dateAdded, categoryID)
              VALUES
                 (:difficulty_id, :idea, :dateAdded, :categoryID)';
    $statement = $db->prepare($query);
    $statement->bindValue(':difficulty_id', $difficulty_id);
    $statement->bindValue(':idea', $idea);
	$statement->bindValue(':dateAdded', date("Y-m-d"));
	$statement->bindValue(':categoryID', $category);
    $statement->execute();
    $statement->closeCursor();

    // Display the Idea List page
    include('sort.php');
}
?>