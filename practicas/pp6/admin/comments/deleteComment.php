<?php
session_start();
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

// Eliminar comentario usando prepared statement
$stmt = $mysqli->prepare('DELETE FROM comments WHERE id = ?');
if(!$stmt){
    header('Location: adminComments.php?error=1');
    exit();
}

$stmt->bind_param('i', $comment_id);

if($stmt->execute()){
    header('Location: adminComments.php?message=deleted');
} else {
    header('Location: adminComments.php?error=1');
}
exit();
?>
