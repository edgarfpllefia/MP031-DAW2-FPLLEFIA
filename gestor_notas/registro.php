<?php
session_start();
require_once ('config.php');

//Verificar si el formulario ha sido enviado

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //1. RECOGER LOS DATOS DEL FORM

    $nombre = $_POST['nombre'];
    $apellidos= $_POST['apellidos'];
    $url_foto = $_POST['foto'];
    $email =  $_POST['email'];
    $password = $_POST['password'];

    //Hasheo la contraseña

    $password_hasheada = password_hash($password, PASSWORD_DEFAULT);

    //Preparo la consula para insertar el un usuario nuevo

    $stmt = $mysqli->prepare(
        "
            INSERT INTO Users (role, nombre, apellidos, foto, email, password)
            VALUES ('alumno', ?, ?, ?, ?, ?)
        "
    );

    //Compruebo que la preparacion ha tenido exito

    if(!$stmt){
        die('Error en la preparación: ' . $mysqli->error);
    }

    //Bindeo los parametros para que no puedan inyectar codigo

    $stmt->bind_param('sssss', $nombre, $apellidos, $url_foto, $email, $password_hasheada);

    //Ejecuto la consulta
    if($stmt->execute()){
        echo 'Usuario registrado correctamente.<br>
        <a href="login.php">Iniciar sesión</a>';
    }else{
        echo 'Error al registrar el usuario: ' . $stmt->error;
    }

    //Cerramos la conexión
    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Registro php</title>
</head>
<body>
    <div>
        <h1>Bienvenido al gestor de notas, registrate para acceder</h1>
        <form action="registro.php" method="POST" class="formulario">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos">
            <label for="foto">URL Foto:</label>
            <input type="text" id="foto" name="foto">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password"> 
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>