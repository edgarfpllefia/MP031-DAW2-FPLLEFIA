
<?php
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $foto = $_POST['foto'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index pp4</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include_once __DIR__ . '/includes/header.php';
    ?>
   <main>
        <div id="tablaProductos">
            <?php
                include_once __DIR__ . '/includes/funciones.php';
                include_once __DIR__ . '/data/productos.php';
                generarTablaProductos($productos);
            ?>
        </div>
        <div id="infoPersona">
            <?php
                include_once __DIR__ .'/includes/funciones.php';
                muestraInfoContacto($nombre, $telefono, $foto);
            ?>
        </div>
    </main>
    <?php
    include_once __DIR__ . '/includes/footer.php';
    ?>
</body>
</html>