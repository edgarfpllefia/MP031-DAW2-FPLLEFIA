<?php 
session_start();

if(isset($_SESSION['user_rol']) || $_SESSION['user_rol'] === 'admin'){
    //El usuario es un administrador, permitir acceso
}else{
    //lo redirigimos al login
    header('Location: /theme/index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel admin</title>
</head>
<body>
    <h1>Panel de administrador</h1>
    <nav>
        <ul>
            <li><a href="news/adminNew.php">Gestionar noticias</a></li>
            <li><a href="news/admin">Gestionar Proyectos</a></li>
            <li><a href="">Gestionar Testimonios</a></li>
            <li><a href="">Gestionar FAQ's</a></li>
        </ul>
    </nav>
</body>
</html>