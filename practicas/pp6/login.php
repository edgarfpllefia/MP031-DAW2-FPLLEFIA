<?php
session_start();
require_once ('theme/config.php');

//1. Verificar si el formulario ha sido enviado
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //2.recoger los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];


    //3.Preparar la consulta para obtener el usuario por el email
    $stmt = $mysqli -> prepare("SELECT id, name, email, password, role FROM users WHERE email = ?");

    //4. Comprobar que la preparacion tuvo exito
    if(!$stmt){
        die('Error en la preparación: ' . $mysqli->error);
    }

    //5. Bindear los parametros
    $stmt -> bind_param('s', $email);

    //6.Ejecutar la consulta
    $stmt -> execute();

    //7. obtener el resultado
    $result = $stmt->get_result();
    //8. comprobar si se encontró un usuario
    if($result->num_rows === 1){
        $user = $result->fetch_assoc();
    }
    //9. Verificar la contraseña
    if(password_verify($password, $user['password'])){
        //10. Iniciar sesion y guardar datos en la sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_rol'] = $user['role'];

        echo 'Inicio de sesion exitoso. Bienvenido, ' . htmlspecialchars($user['name']) . '!';
        //Redirigir a una pagina protegida o al panel de usuario
        header('Location: /theme/index.php');
        exit();
    }else{
        echo 'Contraseña incorrecta';
    }
}
?>

<form action="login.php" method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <input type="submit" value="Iniciar sesión">
</form>