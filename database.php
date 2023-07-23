<?php

$host = "localhost:3307";
$username = "burhan";
$password = "burhan123";
$dbname = "login_db";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ( $mysqli->connect_errno ){
    die("Connection error");
}

return $mysqli;

?>