<?php
include __DIR__ . '/peliculas.php';
?>



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
                    echo "<div class='contenedorImagen'>";
                    echo "<img src=".$pelicula['Imagen (URL)']." alt=''>";                 
                            echo "<div class='hoverPelicula'>";
                                    echo "<h3>" .$pelicula['Nombre de la película']. "</h3>";
                                    echo "<div class='horarios'>";
                                    forEach($pelicula['Horarios de proyección'] as $horario){
                                        echo "<p>" .$horario. "</p>";
                                    }
                                    echo "</div>";
                                    echo "<div class='botonesHover'>";
                                    echo "<a href='trailer.php?id=".$indice."' target='_blank' ><button class='trailer'>TRAILER</button></a>";
                                    echo "<a href='detall.php?id=".$indice."' target='_blank' ><button class='info'>INFO</button></a>";
                                    echo "</div>";
                                    $puntuacion = $pelicula['Nota'];
                                    for($i = 0 ; $i < $puntuacion ; $i++){   
                                       echo "<svg class='estrella' viewBox='0 0 24 24'><path fill='currentColor' d='M12 .587l3.668 7.431 8.2 1.193-5.934 5.782 1.402 8.175L12 18.896l-7.336 3.872 1.402-8.175L.132 9.211l8.2-1.193L12 .587z'/></svg>";
                                    }
                                    for($x = $puntuacion ; $x < 5 ; $x++){
                                        echo "<svg class='estrella apagada' viewBox='0 0 24 24'><path fill='currentColor' d='M12 .587l3.668 7.431 8.2 1.193-5.934 5.782 1.402 8.175L12 18.896l-7.336 3.872 1.402-8.175L.132 9.211l8.2-1.193L12 .587z'/></svg>";
                                    }
                            echo "</div>";                          
                    echo "</div>";
                }
                ?>
            </div>
        </main>
    </div>
</body>

<svg></svg>
</html>