<?php
session_start();
require_once '../../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../../login.php');
    exit();
}

if(!isset($_GET['id']) || empty($_GET['id'])){
    header('Location: ../adminDashboard.php');
    exit();
}else{
    $id = (int) $_GET['id'];
}

$stmt = $mysqli->prepare("DELETE FROM vehiculos WHERE id = ?");
$stmt->bind_param('i', $id);
if($stmt->execute()){
    header('Location: adminCoche.php');
    exit();
}

?>