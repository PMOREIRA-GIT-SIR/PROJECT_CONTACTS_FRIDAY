<?php
define("HOSTDB","localhost");
define("USERDB","ctel_fri_list");
define("PASSDB","ctel_fri_list");

define("NAMEDB","CONTEL_FRIDAY");

// estabelece ligação MySQLi

@$conn = new mysqli(HOSTDB,USERDB,PASSDB,NAMEDB);

// erro ?
if ($conn->connect_errno) {
	echo ($conn->connect_error);
	exit;
} else {
	// echo ("sucesso");
}
?>

<html>
	<form action="connect.php" method='GET'>
		<input type="text" name="pesq" placeholder="pesquisa"/>
	</form>
<?php

if (isset($_GET['pesq'])) {
	$pesq = '%'.$_GET['pesq'].'%';
} else {
	$pesq = '%';
}
// consult SQL
$consultSQL = "SELECT * FROM contatos WHERE (tags LIKE '$pesq' OR nome LIKE '$pesq')";

// execute SQL ( ) - result is a mysqli_result object
$consult = $conn->query($consultSQL);

// erro na consulta?
if ($conn->errno) {
	header("location: http://google.com");
	echo ($conn->error);
	exit;
} else {
	echo ("sucesso");
}

// iterate result
while ($contato = $consult->fetch_object()) {
	echo "<div>";
	echo $contato->nome." ".$contato->apelido." ".$contato->telemovel;
	echo "</div>";
}


/*
// reposition result counter to 0
$consult->data_seek(0);

while ($contato = $consult->fetch_array()) {
	echo "<div>";
	echo $contato[1]." ".$contato[2]." ".$contato[4];
	echo "</div>";
}
	// reposition result counter to 0
$consult->data_seek(0);

while ($contato = $consult->fetch_assoc()) {
	echo "<div>";
	echo $contato["nome"]." ".$contato["apelido"]." ".$contato["telemovel"];
	echo "</div>";
}
*/
?>
</html>

