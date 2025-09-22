<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            box-sizing: border-box;
            margin: 0;
            height: 100vh;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-size: 20px;
            font-weight: bold;
            background-image: url("https://static.vecteezy.com/system/resources/previews/012/613/095/non_2x/scenery-of-the-four-seasons-of-nature-with-landscape-spring-summer-autumn-and-winter-in-template-hand-drawn-cartoon-flat-style-illustration-vector.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        main{
            border: 2px solid black;
            background-color: rgba(234, 232, 233, 0.9);
        }

        .divTemperaturas{
            width: 250px;
            max-width: 250px;
            max-height: 100px;
            padding: 5px;
            text-align: center;
            margin: 10px;
            border-radius: 6px;
        }

        #divContenedores{
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            width: 1000px;
            max-width: 1000px;
        }

    </style>
</head>
<body>
    <header>
        </header>
        
        <?php

$temperatura = [
    "Frio",
    "Temperatura suave",
    "Calor",
];



?>
    <main>   
        <h1>Clasificación de temperaturas</h1>
        <div id="divContenedores">
            <?php
            for($i = 0 ; $i < 10 ; $i++){

                $random = rand(-10,40);

                //Creo una variable string, con el background-color dentro y le asocio la variable con style al contenedor.
                //Útil para el futuro con problemas iguales al que estaba teniendo.

                if($random < 10){
                    $bg = "rgba(0, 173, 205, 1)";
                }elseif($random > 25){
                    $bg = "rgba(215, 0, 0, 1)";
                }else{
                    $bg = "rgba(255, 220, 0, 1)";
                }

                echo "<div class='divTemperaturas' style='background-color: $bg'>
                    <p class='numeroRandom'>$random °C</p>";
                    if($random < 10){
                echo "<p class='fraseUno'>$temperatura[0]</p>";
                    }if($random > 9 && $random < 26 ){
                echo "<p class='fraseDos'>$temperatura[1]</p>";
                    }if($random > 25){
                echo "<p class='fraseTres'>$temperatura[2]</p>";
                    }
                echo "</div>";
                $total = $total + $random;
            };

            $total = $total / 10; 
                ?>
        </div>
        <?php
        echo "<p>La temperatura media es $total °C</p>";
        ?>
    </main>
</body>
</html>