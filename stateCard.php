
<!DOCTYPE html>
<html>
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

<h2> </h2>

<div class="card">
  <img src="img_avatar2.png" alt="Avatar" style="width:100%">
  <div class="container">
    <h4><b>echo $labels[$0]</b></h4>
    $i =1;
foreach($row as $col)
{
	echo $labels[$i] . ": " . $col . "<br>";
	$i++;
}
  </div>
</div>

</body>
</html>
?>
