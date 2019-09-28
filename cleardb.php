<?php

$url = parse_url(getenv("mysql://b3ba3197c1465a:d29468f2@us-cdbr-iron-east-02.cleardb.net/heroku_bf15bd8453ae177?reconnect=true"));

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