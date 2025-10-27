<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_GET['user'])){
    
        $user = $_GET['user'];
        $password = $_GET['password'];

        if($user == 'edgar' && $password == '123456' && $user != "" && $password != ""){
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;

            header('Location: form.php');
            exit; // Detiene el código después de redirigir
        }else{
            // Guardamos el error en la sesión y redirigimos limpio
            $_SESSION['error'] = "Usuario o contraseña incorrectos.";
            header('Location: login.php');
            exit;
        }
    }
}else{
    echo 'no has enviado nada';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login web</title>
</head>
<body>
    <h1>Introduce tus credenciales de usuario</h1>

    <!-- Mostrar error solo si existe en la sesión -->
    <?php
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'>" . htmlspecialchars($_SESSION['error']) . "</p>";
        unset($_SESSION['error']); // lo eliminamos tras mostrarlo
    }
    ?>

    <form action="" method="GET">
        <label for="user">User:</label>
        <input type="text" name="user" required>
        <label for="password">Contraseña: </label>
        <input type="password" name="password" required>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>

<!-- Volverme a mirar el tema de las el mensaje de error ya que al final lo sacamos de chatgpt.
El mensaje de error, si nos logueabamos mal y haciamos F5, seguia saliendo el mensaje de error. -->


