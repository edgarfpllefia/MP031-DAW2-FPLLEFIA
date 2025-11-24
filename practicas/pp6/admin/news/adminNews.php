
<?php
session_start();
require_once './practicas/pp6/theme/config.php';

    if(!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !=='admin'){
        //lo redirigimos al login
        header('Location: index.php');
        exit();
    }
    //recoger las noticias de bbdd
    $result = $mysqli ->query('SELECT * FROM news ORDER BY date_publication DESC');
    $news = $result -> fetch_all(MYSQLI_ASSOC);
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
    <h1>Gestion de noticias</h1>
    <a href="createNews.php">Crear nueva noticia</a>

    <!-- creo la tabla con html y los ty con foreach -->
     <table border="1">
        <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Subtitulo</th>
            <th>Descripcion</th>
            <th>Fecha publicacion</th>
            <th>Acciones</th>
        </tr>
        <?php foreach($news as $item): ?>
            <tr>
                <td>htmlspecialchars($item['id'])</td>
                <td>htmlspecialchars($item['id'])</td>
                <td>htmlspecialchars($item['id'])</td>
                <td>htmlspecialchars($item['id'])</td>
                <td>htmlspecialchars($item['id'])</td>
                <td>
                    <a href="editNews.php?id="></a>
                    <a href=""></a>
                </td>
            </tr>
        }
     </table>
 </body>
 </html>

 <!-- TENGO COSAS MAL AQUÍ, NECESITO CODIGO -->