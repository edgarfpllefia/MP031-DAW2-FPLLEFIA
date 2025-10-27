<?php
session_start();

require_once 'functions.php';

$user = $_SESSION['username'];
$password = $_SESSION['password'];
$image = $_SESSION['image'];
$role = $_SESSION['role'];
$titulo = "";
$img = "";
$autor = "";
$desc = "";

$editMode = false;

if($role != 'admin'){
    header('Location: home.php');
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    if(isset($_SESSION['libros'][$id])){
        $editMode = true;
        $libros = $_SESSION['libros'][$id];

        $titulo = $libros['titulo'];
        $autor = $libros['autor'];
        $desc = $libros['desc'];
        $img = $libros['img'];
    }
}
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $desc = $_POST['desc'];
    $img = $_POST['img'];

    if($editMode){
        editarLibro($id, $titulo, $autor, $desc, $img);
    }else{
        crearLibro($titulo, $autor, $desc, $img);
    }

    header('Location: home.php');
    exit;
}




?>

<!-- AQUI VA LA LÓGICA PHP  -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Virtual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Encabezado del formulario -->
    <?php
    include_once __DIR__ . '/includes/header.php';
    ?>

    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold"></h2>
            <p class="lead"></p>
        </div>

        <!-- Formulario para agregar o editar libro. DEPENDIENDO DE SI SE AÑADE O SE EDITA CAMBIARÁN COSA DEL FORMULARIO, USA TERNARIOS SON MUY ÚTILES-->
        <form method="POST" class="mx-auto" style="max-width: 600px;">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $titulo ?>" placeholder="Título" required>
                <label for="titulo">Titulo</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="autor" name="autor" value="<?= $autor ?>" placeholder="Autor" required>
                <label for="autor">Autor</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="imagen" name="img" value="<?= $img ?>" placeholder="URL de la Imagen">
                <label for="imagen">URL de la Imagen</label>
            </div>
            <div class="form-floating mb-4">
                <textarea class="form-control" id="descripcion" name="desc" placeholder="Descripción" style="height: 150px;"><?= $desc ?></textarea>
                <label for="descripcion">Descripción</label>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg"></button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>