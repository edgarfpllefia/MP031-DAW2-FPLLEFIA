<?php
session_start();
require_once '../config.php';


if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: login.php');
    exit();
}

if(!isset($_GET['id']) || empty($_GET['id'])){
    header('Location: login.php');
}else{
    $id = (int) $_GET['id'];
}

$stmt = $mysqli->prepare("DELETE FROM Notas WHERE id = ?");

if(!$stmt){
    die("Error en la preparacion" . $mysqli->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();

if($stmt->affected_rows > 0){
    header('Location: adminNotas.php');
} else {
    echo "No se borró nada. ID incorrecto o no existe.";
}

?>
