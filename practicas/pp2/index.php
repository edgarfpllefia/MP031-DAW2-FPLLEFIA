<?php
    $ejercicios = [
        'ex1.php',
        'ex2.php',
        'ex3.php',
        'extra1.php',
        'extra2.php',
    ];

    $total = count($ejercicios);
    $contador = 1;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    
    body{
        margin: 0;
        box-sizing: border-box;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        font-size: 18px;
        font-weight: bold;
        background-image: url("https://pentagono.es/wp-content/uploads/2019/03/Pizarra.jpg");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    #divPrincipal{
        width: 700px;
        height: 500px;
        background-color: rgba(255, 255, 255, 0);
        color: white;
        text-align: center;
    }

    #divPrincipal a{
        color: white;
    }

    #divPrincipal a:hover{
        color: rgba(241, 80, 88, 1);
    }

</style>
<body>
    <div id="divPrincipal">
        <header>
            <h1>Práctica 2</h1>
        </header>
        <main>
            <?php
                for($i = 0 ; $i < $total ; $i++){
                    echo "<p>Ejercicio $contador</p>
                    <a href=$ejercicios[$i]>Entra en el ejercicio $contador</a>";
                    $contador = $contador + 1;
                }
            ?>
        </main>
    </div>
</body>
</html>