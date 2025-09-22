<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<style>
    body{
        text-align: center;
        margin: 0;
        box-sizing: border-box;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        font-size: 16px;
        font-weight: bold;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }  

    h1{
        margin: -6rem 0 6rem 0;
    }

    #divPrincipal{
        border: 1px solid black;
        border-radius: 6px;
        background-color: rgba(245, 171, 64, 0.52);
        padding: 1rem;
    }

    .divNumeros{
            display: grid;
            grid-template-columns: repeat(15, max-content); /* Lo utilizo para hacer solo 5 columnas por fila*/
            gap: 3px;
        }

</style>
<body>
    <div id="divPrincipal">
        <h1>Números pares entre 50 y 500</h1>
            <div class="divNumeros">
                <?php 

                for ($i = 50 ; $i <= 500 ; $i++ ){
                     $valor = $i % 2;
                        if($valor == 0){
                        echo "<div class='divNumeros'>$i</div>";
                        }
                    }
                ?>
            </div>
    </div>
</body>
</html>