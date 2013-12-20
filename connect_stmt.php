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
$consultSQL_stmt = $conn->prepare("SELECT nome,apelido,telemovel FROM contatos WHERE (tags LIKE ? OR nome LIKE ?)");

$consultSQL_stmt->bind_param('ss',$pesq,$pesq);
$consultSQL_stmt->execute();
$consultSQL_stmt->bind_result($nome,$apelido,$telele);

// iterate result
while ($consultSQL_stmt->fetch()) {
	echo "<div>";
	echo $nome." ".$apelido." ".$telele;
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

