<?php
session_start();
require_once ('config.php');


//Verifico si el formulario ha sido enviado
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Aqui preparo la consulta en base al email por eso solo tiene un ?
    $stmt = $mysqli -> prepare("SELECT id, role, nombre, apellidos, foto, email, password FROM Users WHERE email = ?");

    //Compruebao que la preparación a tenido éxito
    if(!$stmt){
        die('Error en la preparación: ' . $mysqli->error);
    }

    //Bindeo los parametros en base a lo que he preparado que es el mail
    $stmt -> bind_param('s', $email);

    //Ejecuto la consulta

    $stmt -> execute();

    //Obtengo resultado 

    $resultado = $stmt ->get_result();

    //Compruebo si se ha encontrado el usuario

    if($resultado->num_rows === 1){
        $usuario = $resultado->fetch_assoc();
    }

    //Verifico la contraseña
    if(password_verify($password, $usuario['password'])){
        //INICIO SESIÓN Y GUARDO LOS DATOS EN SESSION

        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_name'] = $usuario['nombre'];
        $_SESSION['user_email'] = $usuario['email'];
        $_SESSION['user_role'] = $usuario['role'];
        $_SESSION['usuario_foto'] = $usuario['foto'];

        echo 'Inicio de sesión completado' . htmlspecialchars($usuario['nombre']) . '!';

        //Redirigir a una página protegida o al panel de usuario

        header('Location: index.php');
        exit();
    }else{
        echo 'Contraseña incorrecta';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login gestor de usuarios</title>
</head>
<body>
    <form action="login.php" method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <input type="submit" value="Iniciar sesión">
</form>
</body>
</html>