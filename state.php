<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 60%;
  height: 60%;
  border-radius: 24px;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

img {
  border-radius: 8px 8px 0 0;
}

.container {
  padding: 100px 16px;
}
</style>
</head>
<body>
<div class="card">
  <div class="container">
<?php
include "cleardb.php";

//echo trim($_REQUEST["state"]);

$q = "select * from state_leg where state = '".trim($_REQUEST["state"])."'";
//echo $q;

$result = $conn->query($q);

$row = $result->fetch_row();

if ($mysqli->connect_errno) 
{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$labels = array("state","convenes","adjourns","carryover","period");
$i =0;
foreach($row as $col)
{
	echo "<h4><b>" .$labels[$i] . ": " . $col . "</b></h4><br>";
	$i++;
}

?>
</div>
</div>
</body>
</html>