<?php
include __DIR__ . '/peliculas.php';
?>

<!-- <?php 
    forEach($peliculas as $pelicula){
        echo "<div class='divPeliculas'>";
            echo "<h3>" .$pelicula['Nombre de la película']. "</h3>";
            echo "<img src='".$pelicula['Imagen (URL)']."'  alt='' > ";
            echo "<div class='horarios'>";
            forEach($pelicula['Horarios de proyección'] as $horario){
                echo "<p>" .$horario. "</p>";
            }
            echo "</div>";
            echo "<p>".$pelicula['Sinopsis']."</p>";
            echo "<p>".$pelicula['Duración']."</p>";
            echo "<p>".$pelicula['Director']."</p>";
            echo "<div class='reparto'>";
            forEach($pelicula['Reparto'] as $reparto){
                echo "<p>" .$reparto. "</p>";
            }
            echo "</div>";
            echo "<p>".$pelicula['Calificación (+16)']."</p>";
            echo "<div class='genero'>";
            forEach($pelicula['Genero'] as $genero){
                echo "<p>" .$genero. "</p>";
            }
            echo "</div>";
            echo "<p>".$pelicula['URL del tráiler (YouTube)']."</p>";
        echo "</div>";
    }
?> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cines Magic</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <header>
            <div><img src="https://www.ocinemagic.es/images/logo-ocine-mag.png#joomlaImage://local-images/logo-ocine-mag.png?width=240&height=119" alt="ocine"></div>
            <div class="menu">
                <nav>
                    <ul>
                        <li>CARTELERA</li>
                        <li>BAR</li>
                        <li>EL CINE</li>
                        <li>SCREEN X</li>
                        <li>SALA KIDS</li>
                        <li>FIDELITY</li>
                        <li>OTROS CINES</li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <section>
                <div class="contenedorCarousel">
                    <img src="https://www.ocinemagic.es/images/banner_content/Guardianes-de-la-Noche.webp" alt="kitmesu no yaiba">
                </div>
            </section>

            <h2>Cartelera</h2>
            <hr>
            <div>
                <div class="variosBotones">
                    <button>Cartelera</button>
                    <button>Vose</button>
                    <button>Screen X</button>
                    <button>Sala Kids</button>
                    <button>Eventos</button>
                    <button>Venta anticipada</button>
                    <button>Próximamente</button>
                </div>
                <div></div>
            </div>
            <div class="cartelera">
                <?php
                forEach($peliculas as $indice => $pelicula){
                    echo "<a href='https://ubiquitous-invention-q7p7jxxxvrqv2xr95-8000.app.github.dev/detall.php?id=".$indice."' target='_blank' ><div class='contenedorImagen'>";
                    echo "<img src=".$pelicula['Imagen (URL)']." alt=''>";                 
                            echo "<div class='hoverPelicula'>";
                                    echo "<h3>" .$pelicula['Nombre de la película']. "</h3>";
                                    echo "<div class='horarios'>";
                                    forEach($pelicula['Horarios de proyección'] as $horario){
                                        echo "<p>" .$horario. "</p>";
                                    }
                                    echo "</div>";
                                    echo "<div class='botonesHover'>";
                                    echo "<button class='trailer'>TRAILER</button>";
                                    echo "<button class='info'>INFO</button>";
                                    echo "</div>";
                            echo "</div>";                          
                    echo "</div></a>";
                }
                ?>
            </div>
        </main>
    </div>
</body>
</html>