<?php
session_start();
require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = $_POST['name'];
    $apellidos = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $direccion = $_POST['address'];

    $password_hasheada = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare('INSERT INTO users(role, nombre, apellido, email, password, direccion) 
                            VALUES("client",?,?,?,?,?)');

    if(!$stmt){
        die("Error al conectar" . $mysqli->error);  
    }

    $stmt->bind_param("sssss", $nombre, $apellidos, $email, $password_hasheada, $direccion);

    if($stmt->execute()){
        $stmt->close();
        $mysqli->close();
        header('Location: login.php');
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro coches.com</title>
</head>
<body>
    <form action="registro.php" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" name="name" required>
        <label for="surname">Apellidos:</label>
        <input type="text" name="surname" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <label for="address">Dirección:</label>
        <input type="text" name="address" required>
        <input type="submit">;
    </form>
</body>
</html>