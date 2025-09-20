<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
    <style>

        body{
            margin: 0;
            min-height: 100vh;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 20px;
            font-weight: 200;
            background-image: url(https://s1.significados.com/foto/random-og.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-color: rgba(0,0,0,0.8);  
            background-blend-mode: multiply;
            color: rgba(255, 255, 255, 1);
            text-shadow: 0px 0px 20px rgba(0,0,0,0.8); 
        }

        #contenedorWeb{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
        }

        h1{
            text-align: center;
        }


        .resultadoPar{
            background-color: green;
            width: 100px;
            height: 50px;
            margin: 10px;
            border: 1px solid black;
            padding: 1rem;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .resultadoImpar{
            background-color: red;
            width: 100px;
            height: 50px;
            border: 1px solid black;
            padding: 1rem;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        p{
            text-align: center;
        }

    </style>
<body>
    <div>   
        <h1>Generador números random</h1>
                <?php
                    $numero = rand(0 , 100);
                    $resultado = $numero % 2;

                    if($resultado == 0){
                        echo "<div id='contenedorWeb'>
                            <div class='resultadoPar'>$numero</div>
                            <div class='resultadoImpar'></div>
                        </div>
                            <div><p>El resultado es par!!</p></div>";
                    }else{
                        echo "<div id='contenedorWeb'>
                            <div class='resultadoPar'></div>
                            <div class='resultadoImpar'>$numero</div>
                        </div>
                            <div><p>El resultado es impar!!</p></div>";
                    }
                ?>
    </div>
</body>
</html>