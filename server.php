<?php

// ENABLE CONFIG
$included=true;

// GET CONFIG
require('config.php');

// OPEN DATABASE
$db = new SQLite3($db['database'],SQLITE3_OPEN_READWRITE);

// GET VARIABLES
$bee['Team'] = $_GET['team'];
$bee['Word'] = filter_var(str_ireplace(":","",$_GET['word']), FILTER_SANITIZE_STRING);

// MAKE WORD UPPERCASE
$bee['Word'] = strtoupper($bee['Word']);

// IF TEAM IS VALID INTEGER
if(filter_var($bee['Team'], FILTER_VALIDATE_INT))
{
	// UPDATE WORD
	$db->query('UPDATE answers SET answer="'.$bee['Word'].'" WHERE id = ' . $bee['Team']);
}

// CLOSE DATABASE
$db->close();

?>