<?php

$host = 'mysql-morenocomasedgar.alwaysdata.net';
$dbname = 'morenocomasedgar_gestor_notas_uab';
$username = '439436';
$password = 'Daw2526.';

$mysqli = new mysqli($host, $username, $password, $dbname);

if($mysqli->connect_error){
    die ("Error de conexion: " . $mysqli -> connect_error);
}else{
    // echo "Conexión exitosa a la base de datos gestor_notas_uab";
}