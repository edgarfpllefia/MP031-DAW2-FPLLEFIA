<?php

$host = 'mysql-morenocomasedgar.alwaysdata.net';
$dbname = 'morenocomasedgar_examencrud';
$username = '439436';
$password = 'Daw2526.';

$mysqli = new mysqli($host, $username, $password, $dbname);

if($mysqli->connect_error){
    die("Error de conexión" . $mysqli->connect_error);
}else{
    
}