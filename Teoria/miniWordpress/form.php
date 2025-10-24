<?php
session_start();

//Inicializo la variable, solo si no existe
if (!isset($_SESSION['noticias'])) {
    $_SESSION['noticias'] = [];
}

// Compruebo si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recojo los datos del formulario
    $title = $_POST['title'] ?? '';
    $content  = $_POST['content'] ?? '';
    $date  = $_POST['date'] ?? '';
    $image  = $_POST['image'] ?? '';
    $category = $_POST['category'] ?? '';

    // Validamos que no estén vacíos
    if (
        !empty(trim($title)) &&
        !empty(trim($content)) &&
        !empty(trim($date)) &&
        !empty(trim($image)) &&
        !empty(trim($category))
    ) {
        // Metemos los datos en el array
        $_SESSION['noticias'][] = [
            'title' => $title,
            'content' => $content,
            'date' => $date,
            'image' => $image,
            'category' => $category
        ];

        echo "<p style='color: green'>Noticia integrada correctamente.</p>";

    } else {
        echo "<p style='color: red'>Todos los campos son obligatorios.</p>";
    }
    
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/form.css">
    <title>Formulario</title>
</head>
<body>
    <form action="form.php" method="POST" >
        <label for="title">Titulo: </label>
        <input type="text" id="title" name="title" required>
    
        <label for="content">Contenido: </label>
        <textarea name="content" id="content"></textarea>
    
        <label for="date">Fecha: </label>
        <input type="text" id="date" name="date" required>
    
        <label for="image">Imagen: </label>
        <input type="text" id="image" name="image" required>
    
        <label for="category">Categoria: </label>
        <input type="text" id="category" name="category" required>
        <input type="submit" value="Enviar Noticia">
    </form>
</body>
</html>
