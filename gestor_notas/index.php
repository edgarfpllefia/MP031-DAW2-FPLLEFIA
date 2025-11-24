<?php
require_once 'config.php';

echo "<h1>Hola mundo</h1>";

//Consulta para obtener lo de la tabla que consideres. Formato de la salida -> 
$users = $mysqli->query("SELECT * FROM Users");

//CAPA 2: CONVIERTO EL RESULTADO ANTERIOR (OBJETO), EN UN ARRAY ASOCIATIVO.

$resultUsers = $users ->fetch_all(MYSQLI_ASSOC);

// Crear la tabla HTML
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr>
        <th>ID</th>
        <th>Role</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Email</th>
      </tr>";

// Recorrer cada usuario y añadir filas
foreach($resultUsers as $user){
    echo "<tr>
            <td>{$user['id']}</td>
            <td>{$user['role']}</td>
            <td>{$user['nombre']}</td>
            <td>{$user['apellidos']}</td>
            <td>{$user['email']}</td>
          </tr>";
}

echo "</table>";
?>
