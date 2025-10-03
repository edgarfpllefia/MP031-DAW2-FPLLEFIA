
<?php
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $foto = $_POST['foto'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include_once __DIR__ . '/includes/header.php';
    ?>
   <main>
        <div>
            <?php
                include_once __DIR__ . '/includes/funciones.php';
                include_once __DIR__ . '/data/productos.php';
                generarTablaProductos($productos);
            ?>
        </div>
        <div>
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