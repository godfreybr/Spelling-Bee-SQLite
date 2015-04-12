<!--

+ Add question
+ Add scores
+ (maybe) Add colour coded marking

-->
<?php
// ENABLE CONFIG
$included=true;
// GET CONFIG
require('config.php');
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Spelling Bee: Kiosk</title>
<style type="text/css">
<!--
/* MAIN PAGE */
#beeTable {
	width: 95%;
}
/* Global Styles */
.bee_teamheader {
	/* Text Styles */
	font-size: 52px;
	/* Padding */
	padding: 5px;
	/* Borders */
	border-top: 1px black solid;
	border-left: 1px black solid;
	/* Size */
	width: 40%;
}
.bee_teambody {
	/* Text Styles */
	font-size: 48px;
	text-align: center;
	/* Padding */
	padding: 5px;
	/* Borders */
	border-bottom: 1px black solid;
	border-left: 1px black solid;
}
.bee_teamscore {
	border: 1px black solid;
	font-size: 76px;
	width: 10%;
}
/* Individual Styles */
#kiosk_title {
	text-align: center;
	font-size: 72px;
}
#bee_t1header {
}
#bee_t1body {
}
#bee_t2header {
}
#bee_t2body {
}
#bee_t3header {
}
#bee_t3body {
}
#bee_t4header {
}
#bee_t4body {
}
#bee_question_type {
	font-size: 68px;
	font-weight: bold;
	margin-top: 50px;
	text-align: center;
}
#bee_question {
	font-size: 68px;
	margin-bottom: 50px;
	text-align: center;
}
ol, ul {
	width: 300px;
	list-style: upper-alpha;
}
-->
</style>
<script>

setInterval(function(){showResult()},300);

function showResult()
{
	xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var teamAnswers=xmlhttp.responseText.split(":");
			if(teamAnswers[0]&&teamAnswers[8])
			{
				// Team 1
				document.getElementById("bee_t1body").innerHTML=teamAnswers[0];
				if (teamAnswers[0]==teamAnswers[8])
				{
					document.getElementById("bee_t1body").style.background="green";
				} else {
					document.getElementById("bee_t1body").style.background="white";
				}
				document.getElementById("bee_t1score").innerHTML=teamAnswers[1];
				
				// Team 2
				document.getElementById("bee_t2body").innerHTML=teamAnswers[2];
				if (teamAnswers[2]==teamAnswers[8])
				{
					document.getElementById("bee_t2body").style.background="green";
				} else {
					document.getElementById("bee_t2body").style.background="white";
				}
				document.getElementById("bee_t2score").innerHTML=teamAnswers[3];
				
				// Team 3
				document.getElementById("bee_t3body").innerHTML=teamAnswers[4];
				if (teamAnswers[4]==teamAnswers[8])
				{
					document.getElementById("bee_t3body").style.background="green";
				} else {
					document.getElementById("bee_t3body").style.background="white";
				}
				document.getElementById("bee_t3score").innerHTML=teamAnswers[5];
				
				// Team 4
				document.getElementById("bee_t4body").innerHTML=teamAnswers[6];
				if (teamAnswers[6]==teamAnswers[8])
				{
					document.getElementById("bee_t4body").style.background="green";
				} else {
					document.getElementById("bee_t4body").style.background="white";
				}
				document.getElementById("bee_t4score").innerHTML=teamAnswers[7];
				
				// Question/Spell
				if (teamAnswers[8].length > 30)
				{
					document.getElementById("bee_question").style.fontSize="32px";
				} else {
					document.getElementById("bee_question").style.fontSize="68px";
				}
				document.getElementById("bee_question").innerHTML=teamAnswers[8];
				document.getElementById("bee_question_type").innerHTML=teamAnswers[9];
				
				// Make spell area go away on non-spell types
				if (teamAnswers[9]=="Spell")
				{
					document.getElementById("bee_t1body").style.display="block";
					document.getElementById("bee_t2body").style.display="block";
					document.getElementById("bee_t3body").style.display="block";
					document.getElementById("bee_t4body").style.display="block";
				} else {
					document.getElementById("bee_t1body").style.display="none";
					document.getElementById("bee_t2body").style.display="none";
					document.getElementById("bee_t3body").style.display="none";
					document.getElementById("bee_t4body").style.display="none";
				}
				
				
				// Round Change
				if (teamAnswers[9]=="Round"||teamAnswers[9]=="&nbsp;")
				{
					document.getElementById("beeTable").style.display="none";
					document.getElementById("kiosk_title").style.display="block";
				} else {
					document.getElementById("beeTable").style.display="block";
					document.getElementById("kiosk_title").style.display="none";
				}
			}
		}
	}
	xmlhttp.open("GET","reader.php",true);
	xmlhttp.send();
}
</script>
</head>

<body>
<h1 id="kiosk_title">The Great Spelling Bee</h1>
<div id="bee_question_type">&nbsp;</div>
<div id="bee_question">&nbsp;</div>
<center>
	<table id="beeTable">
		<tr>
			<th id="bee_t1header" class="bee_teamheader">Team 1</th>
			<th id="bee_t1score" class="bee_teamscore" rowspan="2">0</th>
			<td>&nbsp;</td>
			<th id="bee_t2header" class="bee_teamheader">Team 2</th>
			<th id="bee_t2score" class="bee_teamscore" rowspan="2">0</th>
		</tr>
		<tr>
			<td id="bee_t1body" class="bee_teambody">&nbsp;</td>
			<td>&nbsp;</td>
			<td id="bee_t2body" class="bee_teambody">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<th id="bee_t3header" class="bee_teamheader">Team 3</th>
			<th id="bee_t3score" class="bee_teamscore" rowspan="2">0</th>
			<td>&nbsp;</td>
			<th id="bee_t4header" class="bee_teamheader">Team 4</th>
			<th id="bee_t4score" class="bee_teamscore" rowspan="2">0</th>
		</tr>
		<tr>
			<td id="bee_t3body" class="bee_teambody">&nbsp;</td>
			<td>&nbsp;</td>
			<td id="bee_t4body" class="bee_teambody">&nbsp;</td>
		</tr>
	</table>
</center>
</body>
</html>