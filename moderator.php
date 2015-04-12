<?php
// ENABLE CONFIG
$included=true;
// GET CONFIG
require('config.php');
// OPEN DB
$db = new SQLite3($db['database']);
// GET CURRENT SCORES
$teamscores = $db->query('SELECT id, score FROM scores LIMIT 4');
while($row = $teamscores->fetchArray(SQLITE3_ASSOC))
{
	$teamScore[$row['id']] = $row['score'];
}
?>
<!doctype html>
<html>
<head>
<title>Spelling Bee: Moderator</title>
<style>
.bee_scoreCounter {
	text-align: center;
	height: 32px;
	width: 75px;
	font-size: 24px;
}
</style>
<script type="text/javascript">

/*
	HTTP Request Function
	Saves a little space
*/

function httpRequest(http)
{
	// Create new HTTP Request (Non-IE only because IE sucks)
	xmlhttp=new XMLHttpRequest();
	
	// Prepare & send request
	xmlhttp.open("GET",http,true);
	xmlhttp.send();
}

// Adjust the teams score
function scoreAdjust(score,team)
{
	httpRequest("manage.php?mode=modifyScore&team="+team+"&score="+score);
}

// Reset all team scores
function resetScores()
{
	httpRequest("manage.php?mode=resetScores");
	document.getElementById("t01_score").value='0';
	document.getElementById("t02_score").value='0';
	document.getElementById("t03_score").value='0';
	document.getElementById("t04_score").value='0';
	
	document.getElementById('scoreReset').disabled=true;
}

// Reset all team answers
function resetAnswers()
{
	httpRequest("manage.php?mode=resetAnswers");
}

// Change the question
function changeQuestion(question)
{
	httpRequest("manage.php?mode=modifyQuestion&question="+question);
}

</script>
</head>
<body>
<h1 align="center">Spelling Bee Admin</h1>
<table align="center">
	<tr>
		<th>Score Admin</th>
		<th>Question Select</th>
		<th rowspan="5" width="200">&nbsp;</th>
		<th>Panel Admin</th>
	</tr>
	<tr>
		<td><table id="beeTable">
				<tr>
					<th id="bee_t1header" class="bee_teamheader">Team 1</th>
					<th id="bee_t2header" class="bee_teamheader">Team 2</th>
				</tr>
				<tr>
					<td id="bee_t1body" class="bee_teambody"><input name="t01_score" type="number" class="bee_scoreCounter" id="t01_score" step="10" title="Team 01 Score" onChange="scoreAdjust(this.value,1)" value="<?php echo $teamScore[1]; ?>" /></td>
					<td id="bee_t2body" class="bee_teambody"><input name="t02_score" type="number" class="bee_scoreCounter" id="t02_score" step="10" title="Team 02 Score" onChange="scoreAdjust(this.value,2)" value="<?php echo $teamScore[2]; ?>" /></td>
				</tr>
				<tr>
					<th id="bee_t3header" class="bee_teamheader">Team 3</th>
					<th id="bee_t4header" class="bee_teamheader">Team 4</th>
				</tr>
				<tr>
					<td id="bee_t3body" class="bee_teambody"><input name="t03_score" type="number" class="bee_scoreCounter" id="t03_score" step="10" title="Team 03 Score" onChange="scoreAdjust(this.value,3)" value="<?php echo $teamScore[3]; ?>" /></td>
					<td id="bee_t4body" class="bee_teambody"><input name="t04_score" type="number" class="bee_scoreCounter" id="t04_score" step="10" title="Team 04 Score" onChange="scoreAdjust(this.value,4)" value="<?php echo $teamScore[4]; ?>" /></td>
				</tr>
			</table></td>
		<td><select name="questionlist" id="questionlist" title="Question List" style="width: 400px;">
				<option value="0" selected="selected">Park Questionair</option>
				<?php
				
				$teamAnswers = $db->query('SELECT questions.id, questions.content, question_types.type, (SELECT config.current_question FROM config LIMIT 1) AS cquestion FROM questions JOIN question_types ON questions.type = question_types.id');
				while($row = $teamAnswers->fetchArray(SQLITE3_ASSOC))
				{
					echo '<option value="' . $row['id'] . '"';
					if($row['cquestion']==$row['id'])
					{
						echo ' selected="selected"';
					}
					echo '>('.$row['type'].') ' . $row['content'] . '</option>';
				}
				
				if($row['cquestion']==$row['id'])
				{
					echo ' selected="selected"';
				}
				
				?>
			</select>
			<input type="button" value="Change" onClick="changeQuestion(document.getElementById('questionlist').value)" /></td>
		<td><input type="button" disabled="disabled" value="Reset Panel" />
			<br>
			<input type="button" value="Clear Questions" onClick="resetAnswers()" />
			<br><br>
<br>
<br>
<br>
<br>
<br>


			<input type="button" onClick="document.getElementById('scoreReset').disabled=false;" value="Safety" /><input name="scoreReset" type="button" disabled="disabled" id="scoreReset" onClick="resetScores()" value="Clear Scores" /></td>
	</tr>
</table>
</body>
</html>
<?php $db->close(); ?>