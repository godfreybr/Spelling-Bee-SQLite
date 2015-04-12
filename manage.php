<?php

// ENABLE CONFIG
$included=true;

// GET CONFIG
require('config.php');

// GET MODE
$mod['mode'] = $_GET['mode'];

// IF MODE IS SET
if(isset($mod['mode']))
{

	// OPEN DATABASE
	$db = new SQLite3($db['database']);
	
	// SELECT OPERATION BASED ON MODE
	switch ($mod['mode'])
	{
		// RESET ALL SCORES
		case "resetScores":
			$db->query('UPDATE scores SET score=0');
			echo "Scores reset";
			break;
			
		// RESET ALL QUESTIONS
		case "resetAnswers":
			$db->query('UPDATE answers SET answer = NULL');
			echo "Answers reset";
			break;
			
		// MAKE SURE TEAM & SCORE ARE DEFINED, THEN CHANGE TEAMS SCORE
		case "modifyScore":
		
			if(isset($_GET['team']) && isset($_GET['score']))
			{
				$db->query('UPDATE scores SET score=' . $_GET['score'] . ' WHERE id = ' . $_GET['team']);
				echo "Score adjusted";
			} else {
				echo "Invalid Arguements";
			}
			break;
			
		// MAKE SURE QUESTION IS DEFINED, THEN SET IT
		case "modifyQuestion":
			if(isset($_GET['question']))
			{
				$db->query('UPDATE config SET current_question=' . $_GET['question']);
				$db->query('UPDATE answers SET answer = NULL');
				echo "Question set";
			} else {
				echo "Invalid Arguements";
			}
			break;
			
		// FAIL ON UNMATCHED MODE
		default:
			echo "INVALID MODE";
	}
	
	// CLOSE DATABASE
	$db->close();

} else {
	// MODE ISN'T SET SO WE FAIL
	echo "Mode not set";
}
?>