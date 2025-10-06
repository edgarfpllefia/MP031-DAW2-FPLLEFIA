<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Web pp4</title>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: "Jost", sans-serif;
            background-color: #F4F4F4;
        }

        form input, form label{
            display: block;
            margin: 10px;
        }

        #formulario{
            background-color: white;
            border: 1px solid black;
            box-shadow: 2px 2px 5px;
            width: 500px;
            padding: 25px;
            display: flex;
            justify-content: center;
        }


    </style>
</head>
<body>
    <div id="formulario">
        <form action="/index.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" placeholder="Nombre">
            <label for="telefono">Teléfono:</label>
            <input type="tel" name="telefono" placeholder="Teléfono">
            <label for="foto">Foto:</label>
            <input type="text" name="foto" placeholder="Enlace de tu foto de perfil">
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>

