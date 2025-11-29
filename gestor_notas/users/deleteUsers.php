<?php 
session_start();
require_once '../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: login.php');
    exit();
}

//Compruebo que la url tenga id y que no esté vacia
if(!isset($_GET['id']) || empty($_GET['id'])){
    header('Location: adminUsers.php');
    exit();
}else{
    $id = (int) $_GET['id'];
}

$stmt = $mysqli ->prepare("DELETE FROM Users WHERE id = ?");

if(!$stmt){
    die("Error en la preparación " . $mysqli->error);
}

//Bindeo el parametro

$stmt ->bind_param('i', $id);

//Ejecuto la consulta

if($stmt ->execute()){
    //Redirecciono al panel de Usuarios
    header('Location: adminUsers.php');
}