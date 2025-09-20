<?php
    $random = rand(1 , 100);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extra 1</title>
</head>
<style>
    body{
        margin: 0;
        box-sizing: border-box;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        text-align: center;
        font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif
    }

    #contenedorWeb{
        background-color: rgba(248, 249, 233, 1);
        border-radius: 16px;
        padding: 2rem;
        min-width: 600px;
        box-shadow: 0px 0px 20px rgba(10, 10, 10, 1), 0px 0px 20px rgba(218, 245, 187, 1);
    }

    .numerosFlex{
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-bottom: 1rem;
    }

    .contador{
        border: 1px solid rgba(59, 88, 185, 1);
        border-radius: 6px;
        background-color: rgba(178, 189, 224, 1);
        color: rgba(59, 88, 185, 1);
        padding: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 1rem 0 1rem 0;
    }

    .esPrimo{
        color: green;
        font-size: 28px;
    }

    .noPrimo{
        color: red;
        font-size: 28px;
    }

</style>
<body>
    <div id="contenedorWeb">
        <?php
        echo "<h1>Número Generado: $random</h1>
        <h2>Divisores de $random</h2>
            <div class='numerosFlex'>";
                    $contador = 1;
                    $primo = 0;
                    while($contador < $random + 1){
                        $valor = $random % $contador;
                        if($contador == 1 || $valor == 0 || $valor == $random){
                            echo "<div class='contador'>$contador</div>";
                        }
                        if($contador == 1 || $contador == $random || $valor == 0 ){
                            $primo = $primo + 1;
                        }
                        $contador = $contador + 1;
                    }
            echo "</div>";
                    if($primo == 2){
                        echo  "<div class='esPrimo'>$random es un número primo</div>";
                    }else{
                        echo  "<div class='noPrimo'>$random no es un número primo</div>";
                    }
                ?>
    </div>
</body>
</html>