<?php

$host = 'mysql-morenocomasedgar.alwaysdata.net';
$dbname = 'morenocomasedgar_pp6';
$username = '439436';
$password = 'Daw2526.';

$mysqli = new mysqli($host, $username, $password, $dbname);

if($mysqli->connect_error){
    die ("Error de conexion: " . $mysqli -> connect_error);
}else{

}