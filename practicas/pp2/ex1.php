<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <h1>Números pares entre 50 y 500</h1>
    <?php 
        for ($i = 50 ; $i <= 500 ; $i++ ){
            $valor = $i % 2;
            if($valor == 0){
                echo "<div>$i</div>";
            }
        }
        ?>

        <style>
            
        </style>
</body>
</html>