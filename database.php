<?php

$host = "localhost:3307";
$username = "foo";
$password = "foo";
$dbname = "login_db";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ( $mysqli->connect_errno ){
    die("Connection error");
}

return $mysqli;

?>
