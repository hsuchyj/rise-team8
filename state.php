<?php
include "cleardb.php";

echo trim($_REQUEST["state"]);

$result = $conn->query("select * from state_leg where state like '%".trim($_REQUEST["state"])."%'");
$row = $result->fetch_row();

if ($mysqli->connect_errno) 
{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$labels = array("state","convenes","adjourns","carryover","period");
for($i = 0; $i < 5; $i++)
{
	echo $labels[$i] . ": " $row[$i] . "<br>";
}
*/
?>