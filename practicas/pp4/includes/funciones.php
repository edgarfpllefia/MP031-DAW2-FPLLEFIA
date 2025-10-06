<?php
include __DIR__ . '/../data/productos.php';


function generarTablaProductos($productos){
    echo "<table border='1' cellpadding='8' cellspacing='0' style='border-collapse:collapse; font-family:Arial;'>";
    echo "<tr style='background:#f0f0f0;'>
            <th>Nombre</th>
            <th>Precio (€)</th>
            <th>Disponibilidad</th>
          </tr>";
    
    foreach($productos as $producto){
        $nom = $producto['nombre'];
        $preu = $producto['precio'];
        $valor = $producto['disponible'] ? "En stock" : "Agotado";

        if($valor == "En stock"){
            $backgroundValor = "style='background-color: #c8f7c5; color: green; font-weight:bold;'";
        } else {
            $backgroundValor = "style='background-color: #f7c5c5; color: red; font-weight:bold;'";
        }


        echo "<tr>
                <td>$nom</td>
                <td>$preu</td>
                <td $backgroundValor>$valor</td>
              </tr>";
    }

    echo "</table>";
}

function muestraInfoContacto($nombre, $telefono, $foto){
    echo "<p>Nombre: $nombre</p>
    <p>Telefono: $telefono</p>
    <div>
    <p>Foto del perfil: <img style=' width:80px;
        height:80px;
        border-radius:50%;
        object-fit:cover;
        margin-bottom: -10px;
        border:2px solid #ccc;' src='".$foto."' alt=''></p>
    </div>";
}

?>