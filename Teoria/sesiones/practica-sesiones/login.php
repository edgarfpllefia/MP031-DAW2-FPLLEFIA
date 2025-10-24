<?php
session_start();

$error= false;
// var_dump($error);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'];
    $password = $_POST['password'];


    if($name === 'edgar' && $password === '123456'){
        $_SESSION ['name'] = $_POST['name'];
        $_SESSION ['password'] = $_POST['password'];
        header('Location: home.php');
    }elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
        $error = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div style="display: flex; justify-content: center; align-items: center;">
        <form action="" method="POST">
            <label for="name">Nombre: </label>
            <input type="text" name="name">
            <label for="password">Password: </label>
            <input type="password" name="password">
            <input type="submit" value="Enviar">
        </form>
    </div>
    <?php 
        if($error){
            echo "<div style='text-align: center';>Contraseña no valida</div>";
        }
    ?>
</body>
</html>
