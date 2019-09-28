<?php
include "cleardb.php";

echo trim($_REQUEST["state"]);

$q = "select * from state_leg where state = '".trim($_REQUEST["state"])."'";
echo $q;

$result = $conn->query($q);

$row = $result->fetch_row();

if ($mysqli->connect_errno) 
{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$labels = array("state","convenes","adjourns","carryover","period");
for($i = 0; $i < 5; $i++)
{
	//echo $labels[$i] . ": " $row[$i] . "<br>";
}

?>