<?php
session_start();
require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");

    if(!$stmt){
        die("Error en la preparacion" . $mysqli->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if($resultado ->num_rows === 1){
        $usuario = $resultado->fetch_assoc();

        if(password_verify($password, $usuario['password'])){
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_role'] = $usuario['role'];
        $_SESSION['user_name'] = $usuario['nombre'];
        $_SESSION['user_email'] = $usuario['email'];
        $_SESSION['user_address'] = $usuario['direccion'];

        if($_SESSION['user_role'] === 'admin'){
            header('Location: admin/adminDashboard.php');
            exit();
        }
    
        if($_SESSION['user_role'] === 'client'){
            header('Location: users/userDashboard.php');
            exit();
        }
    }else{
        header('Location: error.php');
        exit();
}
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="login.php" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" required>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <input type="submit">
    </form>
</body>
</html>