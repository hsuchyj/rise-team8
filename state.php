<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/multiColumnTemplate.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <h4 class="logo"> RISE </h4>
    <nav>
      <ul>
        <li><a href="#about"><a href="Rise Home Page.php">HOME</a></a></li>
		<li><a href="#about"><a href="About Page.html">ABOUT</a></a></li>
		<li><a href="#about"><a href="map.html">MAP</a></a></li>
		<li><a href="#about"><a href="FAQ.html">FAQ</a></a></li>
      </ul>
    </nav>
  </header>
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
<div class="copyright">&copy;2019 - <strong> JPMorgan Code for Good </strong></div>
</body>
</html>