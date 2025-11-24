<?php
require_once ('theme/config.php');
session_start();

// Verificar si el formulario ha sido enviado
if($_SERVER['REQUEST_METHOD'] === 'POST' ){
    //1. RECOGER LOS DATOS DEL FORM

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = 'user'; // Rol por defecto

    //2. Hasheamos la contraseña
    $password_hasheada = password_hash($password, PASSWORD_DEFAULT);

    //3. Preparamos la consulta para insertar el nuevo usuario
    //   Ajustada a las columnas reales de tu tabla "users"
    $stmt = $mysqli->prepare("
        INSERT INTO users (role, name, surname, password, email, register_date, photo)
        VALUES ('admin', ?, '', ?, ?, NOW(), NULL)
    ");

    //4. Comprobar que la preparación tuvo exito
    if(!$stmt){
        die('Error en la preparación: ' . $mysqli->error);
    }

    //5. Bindeamos los parametros
    //   name, password, email → sss
    $stmt->bind_param('sss', $name, $password_hasheada, $email);

    //6. Ejecutamos la consulta
    if($stmt->execute()){
        echo 'Usuario registrado correctamente. <a href="login.php">Iniciar sesión</a>';
    }else{
        echo 'Error al registrar el usuario: ' . $stmt->error;
    }

    //7. Cerramos conexión
    $stmt->close();
    $mysqli->close();
}
?>

<form action="register.php" method="POST">
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <input type="submit" value="Enviar">
</form>