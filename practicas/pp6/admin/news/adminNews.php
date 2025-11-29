<?php
session_start();
require_once './practicas/pp6/theme/config.php';

if(!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin'){
    header('Location: index.php');
    exit();
}

$result = $mysqli->query('SELECT * FROM news ORDER BY date_publication DESC');
$news = $result->fetch_all(MYSQLI_ASSOC);
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
            <td><?= htmlspecialchars($item['id']) ?></td>
            <td><?= htmlspecialchars($item['title']) ?></td>
            <td><?= htmlspecialchars($item['subtitle']) ?></td>
            <td><?= htmlspecialchars($item['description']) ?></td>
            <td><?= htmlspecialchars($item['date_publication']) ?></td>
            <td>
                <a href="editNews.php?id=<?= $item['id'] ?>">Editar</a>
                <a href="deleteNews.php?id=<?= $item['id'] ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
