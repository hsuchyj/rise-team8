<?php
include "cleardb.php";

$result = $conn->query("select * from state_leg where state = '".$_REQUEST["state"] ."'");
$row = $result->fetch_row();

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

for($i = 0; $i < 4; $i++)
{
	echo $row[$i] . "<br>";
}
?>