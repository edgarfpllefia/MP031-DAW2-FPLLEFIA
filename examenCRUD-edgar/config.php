<?php

$host = 'mysql-morenocomasedgar.alwaysdata.net';
$dbname = 'morenocomasedgar_rentbox';
$username = '439436';
$password = 'Daw2526.';

$mysqli = new mysqli($host, $username, $password, $dbname);

if($mysqli->connect_error){
    die('error de conexion' . $mysqli->connect_error);
}else{
    
}