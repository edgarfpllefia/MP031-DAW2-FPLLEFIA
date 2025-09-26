<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
    <style>

        body{
            box-sizing: border-box;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .divPrincipal{
            width: 1500px;
            height: 300px;
            border: 1px solid black;
            display: flex;
        }

        .divAzul{
            width: 200px;
            height: 200px;
            border: 1px solid blue;
            background-color: blue;
            color: white;
        }
        .divGris{
            width: 200px;
            height: 200px;
            border: 1px solid grey;
            background-color: grey;
            color: white;
        }
        .divVerde{
            width: 200px;
            height: 200px;
            border: 1px solid green;
            background-color: green;
            color: white;
        }
    </style>
</head>
<body>
    <?php 
        $lista = [];
        for($i = 0 ; $i < 30 ; $i++){
        $random = rand(0,100);
        array_push($lista, $random);
        }

        $listaAzul = [];
        $listaGris = [];
        $listaVerde = [];
        
        for($j = 0 ; $j < count($lista) ; $j++){
            if($lista[$j] < 33){
                array_push($listaAzul, $lista[$j]);
            }
            if($lista[$j] >= 33 && $lista[$j] <= 66){
                array_push($listaGris, $lista[$j]);
            }
            if($lista[$j] > 66){
                array_push($listaVerde, $lista[$j]);
            }
        }
    ?>
    <div class="divPrincipal">
        <div class="divAzul">
        <?php
            for($i = 0 ; $i < count($listaAzul) ; $i++){
            echo "<p>$listaAzul[$i]</p>";
        }
        ?>
        </div>
        <div class='divVerde'>
        <?php
        for($i = 0 ; $i < count($listaVerde) ; $i++){
            echo "<p>$listaVerde[$i]</p>";
        }
        ?>
        </div>
        <div class='divGris'>
        <?php
        for($i = 0 ; $i < count($listaGris) ; $i++){
            echo "<p>$listaGris[$i]</p>";
        }
        ?>
        </div>
    </div>
</body>
</html>