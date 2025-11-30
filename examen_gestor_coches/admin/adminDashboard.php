<?php
session_start();
require_once '../config.php';

$role = $_SESSION['user_role'];
$nombre = $_SESSION['user_name'];

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administrador</title>
</head>
<body>
    <h1>Bienvenido al panel de administrador <?= $nombre ?> </h1>
    <h2>Tu rol es <?= $role ?></h2>
    <h3>Que quieres administrar</h3>
    <h3><a href="adminUsuarios.php">Usuarios</a></h3>
    <h3><a href="adminAlquiler.php">Alquiler</a></h3>
    <h3><a href="adminCoches.php">Coches</a></h3>
</body>
</html>