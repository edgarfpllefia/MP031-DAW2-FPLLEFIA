<?php
session_start();
require_once('../../theme/config.php');

// Verificar que el usuario sea admin
if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../../login.php');
    exit();
}

// Obtener y validar ID del comentario
if(!isset($_GET['id']) || empty($_GET['id'])){
    header('Location: adminComments.php?error=1');
    exit();
}

$comment_id = (int) $_GET['id'];

// Actualizar estado a aprobado usando prepared statement
$stmt = $mysqli->prepare('UPDATE comments SET status = ? WHERE id = ?');
if(!$stmt) {
    header('Location: adminComments.php?error=1');
    exit();
}

$status = 'approved';
$stmt->bind_param('si', $status, $comment_id);

if($stmt->execute()) {
    header('Location: adminComments.php?message=approved');
} else {
    header('Location: adminComments.php?error=1');
}

$stmt->close();
exit();
?>
require_once('../../theme/config.php');

// Verificar que el usuario sea admin
if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../../login.php');
    exit();
}

// Obtener ID del comentario (GET) y validarlo
$comment_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($comment_id <= 0){
    header('Location: adminComments.php');
    exit();
}

// Actualizar estado a 'approved' usando prepared statement
$stmt = $mysqli->prepare('UPDATE comments SET status = ? WHERE id = ?');
if(!$stmt){
    header('Location: adminComments.php?error=1');
    exit();
}

$status = 'approved';
$stmt->bind_param('si', $status, $comment_id);

if($stmt->execute()){
    header('Location: adminComments.php?message=approved');
} else {
    header('Location: adminComments.php?error=1');
}
exit();
?>
