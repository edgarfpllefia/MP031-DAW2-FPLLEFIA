<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="inicio.php" method="post">
        <input type="text" name="usuario" placeholder="Usuario">
        <input type="password" name="contraseña" placeholder="contraseña">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>

<?php


//recoge los datos del formulario
//Acordarse de cambiar el method del form para enviarmelo como uno quiera, get o post.
//Desde GET - Formulario a URL
echo $_GET['nom'];

echo '<br>';

echo $_GET['edat'];


//Desde POST - Formulario directo
$usuario =  $_POST['usuario'];

echo '<br>';

$contraseña =  $_POST['contraseña'];

if($usuario === "edgar" && $contraseña == 123){
    echo "Usuario logueado con exito";
}else{
    echo "ERROR EN EL LOGUIN";
}

?>