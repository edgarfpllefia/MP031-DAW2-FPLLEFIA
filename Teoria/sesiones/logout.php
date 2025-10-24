<?php
session_start();

$nombre = $_SESSION['user'];

//Elimino solo el rol que yo quiero -> 
// unset($_SESSION['role']);


// PARA DESTRUIR LA SESION ENTERA -> 
session_destroy(); 
//Porfin me voy al home redirigido
header('Location: index.php');

