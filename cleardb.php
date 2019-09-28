<?php

$url = parse_url(getenv("us-cdbr-iron-east-02.cleardb.net"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);

?>