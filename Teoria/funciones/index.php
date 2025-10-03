<?php 

    function sumna ($a, $b){
        return $a + $b;
    }

    function generarSaludo($nombre){
        return "<h1>Hola" .$nombre."!</h1>";
    }

    echo generarSaludo("Juan");

    function calcularTotal($precio, $cantidad, $impuesto){
        $subtotal = $precio * $cantidad;
        $total = $subtotal + ($subtotal * $impuesto / 100);
        return $total;
    }

echo calcularTotal(100, 2, 21);

//Implode
$palabras = ["Hola", ",mundo", "desde", "PHP"];

$palabras_implode = implode(",", $palabras);
echo $palabras_implode;

//explode
$cadena = "Hola,mundo,desde,PHP";
$palabras_explode = explode(",", $cadena);
print_r($palabras_explode);


?>