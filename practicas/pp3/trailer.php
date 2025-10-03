<?php
include  __DIR__ . '/peliculas.php';
$id = $_GET["id"];
$pelicula = $peliculas[$id];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Trailer ".$pelicula['Nombre de la película']."" ?></title>
    <style>

        body{
            margin: 0;
            height: 100vh;
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        iframe{
            width: 944px;
            height: 500px;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <div>
        <?php
       echo "<iframe src='".$pelicula['URL del tráiler (YouTube)']."' 
        frameborder='0' 
        allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' 
        allowfullscreen>
      </iframe>";
        ?>
    </div>
</body>
</html>