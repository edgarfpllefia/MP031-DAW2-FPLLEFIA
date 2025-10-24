<?php 

//PRIMER CLASE CON SESIONES

session_start();

$_SESSION['user'] = 'Maria';
$_SESSION['role'] = 'admin';

echo 'Sesion iniciada con éxito';
echo '<br>';
echo 'Usuario: ' .$_SESSION['user'];
echo '<br>';
echo 'Rol: ' .$_SESSION['role'];
echo '<br>';
