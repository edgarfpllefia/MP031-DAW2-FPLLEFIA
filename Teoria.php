<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria</title>
</head>
<body>
    <!-- <?php
        $nom = 'Edgar';
        $apellido = 'Moreno';
        $edad = 32;
        $frase = "Hola soy $nom $apellido y tengo $edad años";
        echo $frase;
    ?>

    <?php

    //condicionales;

        if($edad<22){
            echo "Eres mayor de edad";
        }else{
            echo "Eres menor de edad";
        }
        

        ?>

<section class="num-padre">
    <h1>Numeros 0-10</h1>
    
    <?php
        //Bucles
        
        for($i = 1 ; $i <= 10 ;$i++){
            echo "<div class='num-box'>Numero: $i<br></div>";
            echo "<div class=\"num-box\">Numero: $i<br></div>";
            echo '<div class="num-box">Numero: ' . $i .' <br></div>';
        }

        ?>
</section>
<style>
    .num-box{
        background-color: red;
        padding: 2rem;
    }

    .num-padre{
        background-color: green;
        gap: 1em;
        display: flex;
        flex-wrap: wrap;
    }
</style> -->

<!-- Tabla -->

<?php
    $peliculas = ["Interestelar", "Origen", "Dune", "Intocable","Cadena Perpetua"];
    $imagenes = [
        "https://beam-images.warnermediacdn.com/BEAM_LWM_DELIVERABLES/aa5b9295-8f9c-44f5-809b-3f2b84badfbf/8a7dd34b09c9c25336a3d850d4c431455e1aaaf0.jpg?host=wbd-images.prod-vod.h264.io&partner=beamcom",
        "https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2014/06/345894-cine-ciencia-ficcion-critica-origen.jpg?tf=3840x",
        "https://beam-images.warnermediacdn.com/BEAM_LWM_DELIVERABLES/e7dc7b3a-a494-4ef1-8107-f4308aa6bbf7/e840571e-b947-49c0-83b2-39cfde921ca2?host=wbd-images.prod-vod.h264.io&partner=beamcom",
        "https://occ-0-8407-2218.1.nflxso.net/dnm/api/v6/Z-WHgqd_TeJxSuha8aZ5WpyLcX8/AAAABVWL-4yk1_VPkyluug-aFV_sa5JoM_rtVCaBHqFsi4k41uItYx8uDMcHMNA09ZW5lRieoKyW7VajjEoyiNMEEOig29zK8FWpEkz_.jpg?r=ecd",
        "https://cloudfront-eu-central-1.images.arcpublishing.com/prisaradio/RYA263EF6NGKZJOZR7625AED5M.jpg",
    ];
    $puntuacion = [10, 9, 8, 4, 8];
?>

<table>
    <tr>
        <th>Nombre</th>
        <th>Imagen</th>
        <th>Puntuación</th>
    </tr>
        <?php
        for($i = 0 ; $i < count($peliculas) ; $i++){
            echo "<tr>
                    <td> $peliculas[$i] </td>
                    <td><img src='$imagenes[$i]'></td>";
                    if($puntuacion[$i] < 5){
                    echo "<td style='background-color: red'><p>$puntuacion[$i]</p></td>";
                    }else{
                        echo "<td style='background-color: green'><p>$puntuacion[$i]</p></td>";
                        }
                    echo "</tr>";
        }
                    
        ?>
</table>
<style>
    table{
        width: 100%;
        border: 1px solid black;
        table-layout: fixed;
    }



    th{
        background-color: yellow;
        border: 1px solid black;
    }

td{
  width: 220px;            
  border: 1px solid black;
  overflow: hidden;         
  vertical-align: middle;
}

td img{
  display: block;
  width: 100%;             
  height: 220px;            
  object-fit: cover;        
}
</style>

</body>
</html>