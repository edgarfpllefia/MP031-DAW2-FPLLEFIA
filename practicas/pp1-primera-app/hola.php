<?php
     function name($nombre){
        echo  "Soy $nombre";
     }

     function hora(){
        date_default_timezone_set('Europe/Madrid');
        echo date("Y-d-m");
     }
     ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Módulo 7</title>
        <link rel="stylesheet" href="hola.css">
    </head>
    <body>
        <header class="flexHeader">
                <img src="./imagenes/logo-fpllefia.jfif" alt="FPLlefia">
                <h1><?php echo "Módulo 7 - Práctica 1. Mi primera aplicación en PHP" ?></h1>
        </header>
        <main class="mainClass">
            <div class="divImagen">
                <img src="./imagenes/imagenEdgar.jpg" alt="Foto Edgar Moreno"> 
            </div>
            <div>
                <ol>
                    <li><?php echo "En el primer recuadro tenemos la apertura para injectar codigo php" ?></li>
                    <li><?php echo "Despues tenemos una funcion que se llama sayHello y le envian el parametro name, devolviendo Hello + name" ?></li>
                    <li><?php echo "Llama a la funcion sayHello enviandole remote world que en la funcion es name" ?></li>
                    <li><?php echo "Es una funcion de php que enseña toda la configuración de entorno de php en el que uno está corriendo" ?></li>
                </ol>
            </div>
        </main>
        <footer>
            <div>
                <p>
                    <?php 
                    name("Edgar Moreno");
                    ?>
                </p>
                <p class="hora">
                    <?php hora() ?> 
                </p> 
            </div>
        </footer>
    </body>
</html>