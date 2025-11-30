<?php
session_start();
require_once '../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: login.php');
    exit();
}

$result = $mysqli->query("SELECT a.*, 
          u.nombre as cliente_nombre, 
          u.apellido as cliente_apellido,
          v.nombre as vehiculo_nombre,
          v.marca as vehiculo_marca
          FROM alquileres a
          JOIN users u ON a.id_user = u.id
          JOIN vehiculos v ON a.id_vehiculo = v.id
          ORDER BY a.created_at DESC");

$alquileres = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button><a href="alquiler/addAlquiler.php">Añadir un alquiler</a></button>
        <table>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Vehículo</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Precio Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php foreach($alquileres as $a): ?>
                <tr>
                    <td><?= $a['id'] ?></td>
                    <td><?= $a['id_user'] ?></td>
                    <td><?= $a['id_vehiculo'] ?></td>
                    <td><?= $a['fecha_inicio'] ?></td>
                    <td><?= $a['fecha_fin'] ?></td>
                    <td><?= $a['precio_total'] ?></td>
                    <td><?= $a['estado'] ?></td>
                    <td><?= $a['created_at'] ?></td>
                    <td><button><a href="alquiler/editAlquiler.php">Editar</a></button></td>
                    <td><button><a href="alquiler/removeAlquiler.php">Eliminar</a></button></td>
                </tr>
                <?php endforeach ?>
        </table>
</body>
</html>