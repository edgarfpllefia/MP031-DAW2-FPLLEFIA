<?php
include __DIR__ . '/peliculas.php';
$id = $_GET["id"];
$pelicula = $peliculas[$id];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detall</title>
    <link rel="stylesheet" href="styleDos.css">
</head>
<body>
    <div class="contenedor">
        <?php 
            echo "<h1>".$pelicula['Nombre de la película']."</h1>";
            echo "<hr>";
            echo "<div class='contenedorFlex'>";
                echo "<div style='padding: 20px;'>
                    <img src='".$pelicula['Imagen (URL)']."' alt=''>
                    <a href='https://ubiquitous-invention-q7p7jxxxvrqv2xr95-8000.app.github.dev/trailer.php?id=$id'><button class='botonTrailer'>TRAILER</button></a>
                    </div>
                    <div style='padding: 20px;'>
                        <p>".$pelicula['Sinopsis']."</p>
                        <p> Duración: ".$pelicula['Duración']."</p>
                        <p> Director: ".$pelicula['Director']."</p>
                        <p> Actores: ".$pelicula['Reparto']."</p>
                        <p> Cualificacion: ".$pelicula['Calificación']."</p>
                        <p> Genero: ".$pelicula['Género']."</p>
                        <div style='background-color: rgb(1, 124, 135); height: 50px; padding: 15px 0 0 10px'>
                            <p style='color: white;'> ATMOS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; forEach ($pelicula['Horarios de proyección'] as $horario){
                                echo "<span>". $horario. "</span>";
                            } 
                            echo "</p>
                        </div>
                    </div>";
        ?>
    </div>
</body>
</html>