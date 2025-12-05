<?php
session_start();
require_once('../../theme/config.php');

// Verificar admin
if((!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') && (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin')){
    header('Location: ../../login.php');
    exit();
}

$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = trim($_POST['title'] ?? '');
    $subtitle = trim($_POST['subtitle'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $date_publication = trim($_POST['date_publication'] ?? date('Y-m-d'));

    if($title === '') $errors[] = 'El título es obligatorio';

    // manejar imagen
    $imagePath = '';
    if(!empty($_FILES['image']['name'])){
        $uploadDir = __DIR__ . '/../../theme/images/blog/';
        if(!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = 'post-' . time() . '.' . $ext;
        $target = $uploadDir . $filename;
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
            // guardar ruta relativa desde theme folder
            $imagePath = 'images/blog/' . $filename;
        }
    }

    if(empty($errors)){
        $stmt = $mysqli->prepare('INSERT INTO news (date_publication, image, title, subtitle, description) VALUES (?, ?, ?, ?, ?)');
        if(!$stmt) die('Error preparar: ' . $mysqli->error);
        $stmt->bind_param('sssss', $date_publication, $imagePath, $title, $subtitle, $description);
        if($stmt->execute()){
            header('Location: adminNews.php?message=created');
            exit();
        } else {
            $errors[] = 'Error al guardar la noticia';
        }
    }
}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear Noticia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
<div class="container py-4">
    <h1>Crear Noticia</h1>
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div>
    <?php endif; ?>

    <form action="addNews.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input name="title" class="form-control" value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Subtítulo</label>
            <input name="subtitle" class="form-control" value="<?php echo htmlspecialchars($_POST['subtitle'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha publicación</label>
            <input name="date_publication" type="date" class="form-control" value="<?php echo htmlspecialchars($_POST['date_publication'] ?? date('Y-m-d')); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Imagen (opcional)</label>
            <input name="image" type="file" accept="image/*" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control" rows="6"><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
        </div>
        <button class="btn btn-primary">Guardar</button>
        <a href="adminNews.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
