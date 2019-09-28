<?php

$url = parse_url(getenv("us-cdbr-iron-east-02.cleardb.net"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

echo $server . " " . $username . " " . $password . " " . $db;
$conn = new mysqli($server, $username, $password, $db);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>