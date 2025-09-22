<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <style>

        body{
            text-align: center;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 20px;
            background-image: url(https://imgs.search.brave.com/f8ny1YIeLJimAAW6Ls8SaRBtQa3dibaQ8hkFpsYfcfY/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdDIu/ZGVwb3NpdHBob3Rv/cy5jb20vMTAwMzgy/MS8xMDAxOS9pLzQ1/MC9kZXBvc2l0cGhv/dG9zXzEwMDE5NTIx/OC1zdG9jay1waG90/by1jb2xvci1udW1i/ZXJzLW9uLXdoaXRl/LmpwZw);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        h1{
            font-size: 50px;
            color: rgba(239, 241, 247, 1);
            text-shadow: 0px 0px 20px rgba(0,0,0,0.8);
        }

        #contenedorWeb{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .divTablas{
            display: grid;
            grid-template-columns: repeat(5, max-content); /* Lo utilizo para hacer solo 5 columnas por fila*/
            gap: 12px;
        }

        .tablaMultiplicar{
            border: 1px solid black;
            width: max-content;
            padding: 20px;
            background-color: rgba(239, 241, 247, 0.93);
        }
    </style>
    <h1>Tablas de multiplicar</h1>
    <?php
        $i = 0;
    echo "<div id='contenedorWeb'>";
        echo "<div class='divTablas'>";
            for($tabla = 1 ; $tabla <= 10 ; $tabla++){
                    echo "<div class='tablaMultiplicar'>";
                    for($contador = 0 ; $contador <= 10 ; $contador++){
                        $resultado = $tabla * $contador;
                        echo "<p>$tabla x $contador = $resultado</p>";
                    }                   
                    echo "</div>";
                    }
        echo "</div>";
    echo "</div>";
                ?>
</body>
</html>