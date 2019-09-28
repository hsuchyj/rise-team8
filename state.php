<?php
include "cleardb.php";

$result = $conn->query("select * from state_leg where state =".$_REQUEST["state"]);
$row = $result->fetch_row();

for($i = 0; $i < 4; $i++)
{
	echo $row[$i] . "<br>";
}


/*
switch ($_REQUEST["state"]) {
    case "Alabama":
        $state = "Alabama";
        echo "Your favorite color is red!";
        break;
    case "Alaska":
        echo "Your favorite color is blue!";
        break;
    case "Arizona":
        echo "Your favorite color is green!";
        break;
    case "Arkansas":
        echo "Your favorite color is green!";
        break;
    case "California":
        echo "Your favorite color is green!";
        break;
    case "Colorado":
        echo "Your favorite color is green!";
        break;
    case "Connecticut":
        echo "Your favorite color is green!";
        break;
    case "Delaware":
        echo "Your favorite color is green!";
        break;
    case "Florida":
        echo "Your favorite color is green!";
        break;
    case "Georgia":
        echo "Your favorite color is green!";
        break;
    case "Hawaii":
        echo "Your favorite color is green!";
        break;
    case "Idaho":
        echo "Your favorite color is green!";
        break;
    case "Illinois":
        echo "Your favorite color is green!";
        break;
    case "Indiana":
        echo "Your favorite color is green!";
        break;
    case "Iowa":
        echo "Your favorite color is green!";
        break;
    case "Kansas":
        echo "Your favorite color is green!";
        break;
    case "Kentucky":
        echo "Your favorite color is green!";
        break;
    case "Louisiana":
        echo "Your favorite color is green!";
        break;
    case "Maine":
        echo "Your favorite color is green!";
        break;
    case "Maryland":
        echo "Your favorite color is green!";
        break;
    case "Massachusetts":
        echo "Your favorite color is green!";
        break;
    case "Michigan":
        echo "Your favorite color is green!";
        break;
    case "Minnesota":
        echo "Your favorite color is green!";
        break;
    case "Mississippi":
        echo "Your favorite color is green!";
        break;case "Alabama":
        echo "Your favorite color is red!";
        break;
    case "Missouri":
        echo "Your favorite color is blue!";
        break;
    case "Montana":
        echo "Your favorite color is green!";
        break;
    case "Nebraska":
        echo "Your favorite color is green!";
        break;
    case "Nevada":
        echo "Your favorite color is green!";
        break;
    case "New Hampshire":
        echo "Your favorite color is green!";
        break;
    case "New Jersey":
        echo "Your favorite color is green!";
        break;
    case "New Mexico":
        echo "Your favorite color is green!";
        break;
    case "New York":
        echo "Your favorite color is green!";
        break;
    case "North Carolina":
        echo "Your favorite color is green!";
        break;
    case "North Dakota":
        echo "Your favorite color is green!";
        break;
    case "Ohio":
        echo "Your favorite color is green!";
        break;
    case "Oklahoma":
        echo "Your favorite color is green!";
        break;
    case "Oregon":
        echo "Your favorite color is green!";
        break;
    case "Pennsylvania":
        echo "Your favorite color is green!";
        break;
    case "Rhode Island":
        echo "Your favorite color is green!";
        break;
    case "South Carolina":
        echo "Your favorite color is green!";
        break;
    case "South Dakota":
        echo "Your favorite color is green!";
        break;
    case "Tennessee":
        echo "Your favorite color is green!";
        break;
    case "Texas":
        echo "Your favorite color is green!";
        break;
    case "Utah":
        echo "Your favorite color is green!";
        break;
    case "Vermont":
        echo "Your favorite color is green!";
        break;
    case "Virginia":
        echo "Your favorite color is green!";
        break;
    case "Washington":
        echo "Your favorite color is green!";
        break;
    case "West Virginia":
        echo "Your favorite color is green!";
        break;
    case "Wisconsin":
        echo "Your favorite color is green!";
        break;
    case "Wyoming":
        echo "Your favorite color is green!";
        break;
    default:
        echo "Scooby Dooby Doo";
		*/
}
?>