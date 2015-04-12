<!--

- Remove clear score

-->

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Spelling Bee: Client</title>
<style type="text/css">
<!--
#spellForm {
	width: 1024px;
	height: 100px;
	font-size: 64px;
	border: 3px solid black;
	text-align: center;
}
#spellReset {
	width: 200px;
	height: 50px;
	font-size: 26px;
}
#teamSelect {
	width: auto;
	position: absolute;
	top: 5px;
	right: 5px;
}
-->
</style>
<script type="text/javascript">

var team='';

function setTeam() {
	
	// Set the team ID
	team=document.getElementById("teamSelection").value;
	
	// Disable the team changer
	document.getElementById("teamSelection").disabled=true;
	document.getElementById("teamSelectOkay").disabled=true;
	document.getElementById("spellForm").disabled=false;
	document.getElementById("spellForm").value='';
}

function updateSpell()
{
	if(team!='')
	{
		// Create new HTTP Request (Non-IE only because IE sucks)
		xmlhttp=new XMLHttpRequest();
		// Get the forms value
		var beeEntry=document.getElementById("spellForm").value;
		// Prepare & send request
		xmlhttp.open("GET","server.php?team="+team+"&word="+beeEntry,true);
		xmlhttp.send();
	}
}

</script>
</head>

<body>
<div id="teamSelect">
	<form>
		<select name="teamSelection" autofocus id="teamSelection">
			<option value="1">Team 1</option>
			<option value="2">Team 2</option>
			<option value="3">Team 3</option>
			<option value="4">Team 4</option>
		</select>
		<input name="teamSelectOkay" type="button" id="teamSelectOkay" title="Select Team" onClick="setTeam()" value="Select Team" />
	</form>
</div>
<center>
	<h1>Spelling Bee client</h1>
	<form spellcheck="false" onkeypress="return event.keyCode != 13;">
		<input type="text" disabled="disabled" id="spellForm" onkeyup="updateSpell()" value="! CONFIGURE TEAM !" spellcheck="false" />
		<br />
		<br />
		<input type="button" id="spellReset" value="Clear" onClick="getElementById('spellForm').value=''; updateSpell()" />
	</form>
</center>
</body>
</html>