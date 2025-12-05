<?php
session_start();
require_once('../../theme/config.php');

// Verificar que el usuario sea admin
if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../../login.php');
    exit();
}

// Obtener ID del comentario
$comment_id = $_GET['id'] ?? null;

if(!$comment_id) {
    header('Location: adminComments.php');
    exit();
}

// Actualizar estado a rechazado
$stmt = $mysqli->prepare('UPDATE comments SET status = ? WHERE id = ?');
$status = 'rejected';
$stmt->bind_param('si', $status, $comment_id);

if($stmt->execute()) {
    header('Location: adminComments.php?message=rejected');
} else {
    header('Location: adminComments.php?error=1');
}
exit();
?>
