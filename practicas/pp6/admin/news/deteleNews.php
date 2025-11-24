<?php

session_start();
require_once('../../config.php');

if($_SESSION['user_rol'] !== 'admin'){
    //Lo redirigimos al login
    header('Location: login.php');
    exit();
}

//recoger el id de lanoticia a eliminar
if(!isset($_GET['id']) || empty($_GET)){

}

//preparar la consulta para eliminar la noticia
$stmt = $mysqli -> prepare("DELETE FROM news WHERE id = ?");
if(!$stmt){
    die("Error en la preparación " . $mysqli ->error);
}

//bindear el parametro

$stmt->bind_param('i', $news_id);

//ejecutar la consulta
if($stmt ->execute()){
    //redireccionar el panel de noticias
    header('Location: index.php');
}

//ESTO ESTÁ MAL, HAY QUE MIRAR COSAS