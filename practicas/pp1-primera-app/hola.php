
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>
    <body class="d-flex flex-column min-vh-100">
        <header class="bg-white shadow py-3 d-flex justify-content-center align-items-center gap-0 column-gap-5">
                <img src="./imagenes/logo-fpllefia.jfif" alt="FPLlefia">
                <h1 class="text-center text-dark"><?php echo "Módulo 7 - Práctica 1. Mi primera aplicación en PHP" ?></h1>
        </header>
        <main class="d-flex justify-content-evenly align-items-center py-4 flex-grow-1">
            <div class="rounded-circle overflow-hidden d-inline-block" style="width: 140px; height: 140px;">
                <img src="./imagenes/imagenEdgar.jpg" alt="Foto Edgar Moreno" class="w-100 h-100 object-fit-cover">
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
        <footer class="bg-secondary text-white py-3 mt-auto">
            <div>
                <p class="text-center mb-1">
                    <?php 
                    name("Edgar Moreno");
                    ?>
                </p>
                <p class="text-center mb-0">
                    <?php hora() ?> 
                </p> 
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </body>
</html>