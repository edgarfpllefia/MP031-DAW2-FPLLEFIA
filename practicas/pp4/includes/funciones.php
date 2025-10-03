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

        echo "<tr>
                <td>$nom</td>
                <td>$preu</td>
                <td>$valor</td>
              </tr>";
    }

    echo "</table>";
}

function muestraInfoContacto($nombre, $telefono, $foto){
    echo "<p>Nombre: $nombre</p>
    <p>Telefono: $telefono</p>
    <p>Foto del perfil: <img src='".$foto."' alt=''></p>";
}

?>