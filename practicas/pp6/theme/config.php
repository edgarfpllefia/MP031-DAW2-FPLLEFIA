<?php

$host = 'mysql-morenocomasedgar.alwaysdata.net';
$dbname = 'morenocomasedgar_pp6';
$username = '439436';
$password = 'Daw2526.';

$mysqli = new mysqli($host, $username, $password, $dbname);

if($mysqli->connect_error){
    die ("Error de conexion: " . $mysqli -> connect_error);
}else{
    /*El echo este se pone para cuando creas todo, ver que se conecta a la bd, una vez que sabes que se conecta, hay que comentarlo.*/ 
    // echo "Conexión exitosa a la base de datos gestor_notas_uab";
}