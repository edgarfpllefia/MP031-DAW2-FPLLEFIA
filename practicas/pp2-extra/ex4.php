<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<style>
    body{
        text-align: center;
        margin: 0;
        box-sizing: border-box;
        font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-size: 16px;
        font-weight: bold;
        padding: 0 10% 1% 10%;
        background-image: url(https://imgs.search.brave.com/NG3fj5OPicneDOJlgESVJDGtq6d8KsA2VDa2HTRGy68/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly90aHVt/YnMuZHJlYW1zdGlt/ZS5jb20vYi9mb25k/by1tYXRlbSVDMyVB/MXRpY28tNzUzMjY2/MC5qcGc);
    }  

    h1{
        margin: 2rem 0 2rem 0;
        color: #fd00cfff;
        background-color: white;
        border: 1px solid #ff00d0;
    }

    .borderDiv{
        border: 1px solid black;                     
        background: linear-gradient(90deg, #ff00d0,#d215d5,#dd92c9);   
        box-shadow: 3px 3px 10px rgba(0,0,0,0.6);                                
    } 

    .divNumeros{
        display: grid;
        grid-template-columns: repeat(12, 1fr); /* 12 columnas iguales */
        gap: 10px;
    }

    .divTotal{
        margin: 2rem 0 2rem 0;
        color: #fd00cfff;
        background-color: white;
        border: 1px solid #ff00d0;
        color:
    }
</style>
<body>
    <div id="divPrincipal">
        <h1>Números pares entre 50 y 500</h1>
            <div class="divNumeros">
                <?php 
            for($contador = 50 ; $contador < 500 ; $contador ++){
                echo "<div class='borderDiv'>";
                $copia = $contador+9;
                echo "<div> Pares entre ".$contador." y ".($copia). "</div>";
                for ($contador ; $contador < $copia ; $contador++ ){  //CAMBIAR EL 500
                    $valorUno = $contador % 2;
                    $valorDos = $contador % 4;
                    $valorTres = $contador % 6;
                    $valorCuatro = $contador % 12;
                        if($valorCuatro == 0){
                        echo "<p class='divNumerosDos' style='color: blue'>$contador";
                        $total = $total + 1;
                        $suma = $suma + $contador;
                        $pares = $pares + 1;
                        $totalSuma = $totalSuma + $suma;
                        }else if($valorTres == 0){
                        echo "<p class='divNumerosDos' style='color: coral'>$contador";
                        $total = $total + 1;
                        $suma = $suma + $contador;
                        $pares = $pares + 1;
                        $totalSuma = $totalSuma + $suma;
                        }else if($valorDos == 0){
                        echo "<p class='divNumerosDos' style='color: aqua'>$contador";
                        $total = $total + 1;
                        $suma = $suma + $contador;
                        $pares = $pares + 1;
                        $totalSuma = $totalSuma + $suma;
                        }else if($valorUno == 0){
                        echo "<p class='divNumerosDos'>$contador";
                        $total = $total + 1;
                        $suma = $suma + $contador;
                        $pares = $pares + 1;
                        $totalSuma = $totalSuma + $suma;
                        }
                    }
                        echo "</p>";
                        echo "<p>Total: $total</p><p>Suma valores: $suma</p>";
                echo "</div>";
                $total = 0;
                $suma = 0;
            }
            echo "<div class='borderDiv'>
                <div> Pares de ".$contador." </div>
                <p class='divNumerosDos'>$contador</p>
                <p>Total: ".($total+1)."</p><p>Suma valores: $contador</p>
                </div>"
                ?>
            </div>
            <?php echo "<div class='divTotal'><p>El número total de pares es: $pares y la suma total de pares es: $totalSuma</p></div>" ?>
    </div>
</body>
</html>