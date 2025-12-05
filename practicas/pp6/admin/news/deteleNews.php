<?php

session_start();
require_once('../../theme/config.php');

// Verificar admin
if((!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') && (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin')){
    header('Location: ../../login.php');
    exit();
}

// validar id
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if($id <= 0){
    header('Location: adminNews.php');
    exit();
}

// eliminar noticia (prepared statement)
$stmt = $mysqli->prepare('DELETE FROM news WHERE id = ?');
if(!$stmt){
    die('Error en la preparación: ' . $mysqli->error);
}
$stmt->bind_param('i', $id);
if($stmt->execute()){
    header('Location: adminNews.php?message=deleted');
    exit();
} else {
    header('Location: adminNews.php?error=1');
    exit();
}