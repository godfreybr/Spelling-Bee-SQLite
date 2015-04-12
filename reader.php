<?php

// Disable ALL error reporting
// Just display a blank page
error_reporting(0);

// ENABLE CONFIG
$included=true;

// GET CONFIG
require('config.php');

// CREATE DB HANDLE
$db = new SQLite3($db['database']);

// GET TEAMS SCORES & ANSWERS
$teamAnswers = $db->query('SELECT answers.answer, scores.score FROM answers, scores WHERE answers.id = scores.id LIMIT 4');
while($row = $teamAnswers->fetchArray(SQLITE3_ASSOC))
{
	// CHECK IF ANSWER IS NULL
	// IF NULL, SUPPLY EMPTY SPACE
	// FIXES "VARIABLE UNDEFINED" ISSUE
	if($row['answer']=='')
	{
		echo "&nbsp;";
	} else {
		echo $row['answer'];
	}
	echo ':' . $row['score'] . ':';
}

// GET THE CURRENT QUESTION AND QUESTION TYPE
$beeQuestion = $db->query('SELECT questions.content, question_types.type FROM questions, config JOIN question_types ON questions.type = question_types.id WHERE questions.id = config.current_question LIMIT 1');
$result = $beeQuestion->fetchArray(SQLITE3_ASSOC);
if($result['content']=='')
{
	echo "&nbsp;:&nbsp;";
} else {
	echo $result['content'] . ':' . $result['type'];
}
// CLOSE DATABASE
$db->close();

?>