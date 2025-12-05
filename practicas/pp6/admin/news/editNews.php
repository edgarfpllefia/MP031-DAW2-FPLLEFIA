<?php
session_start();
require_once('../../theme/config.php');

// Verificar admin
if((!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') && (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin')){
    header('Location: ../../login.php');
    exit();
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if($id <= 0){
    header('Location: adminNews.php');
    exit();
}

// Obtener noticia
$stmt = $mysqli->prepare('SELECT id, date_publication, image, title, subtitle, description FROM news WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();
$news = $res->fetch_assoc();
if(!$news){
    header('Location: adminNews.php');
    exit();
}

$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = trim($_POST['title'] ?? '');
    $subtitle = trim($_POST['subtitle'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $date_publication = trim($_POST['date_publication'] ?? date('Y-m-d'));

    if($title === '') $errors[] = 'El título es obligatorio';

    // imagen nueva opcional
    $imagePath = $news['image'];
    if(!empty($_FILES['image']['name'])){
        $uploadDir = __DIR__ . '/../../theme/images/blog/';
        if(!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = 'post-' . time() . '.' . $ext;
        $target = $uploadDir . $filename;
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
            // eliminar anterior si existe
            if(!empty($news['image'])){
                $old = __DIR__ . '/../../theme/' . $news['image'];
                if(file_exists($old)) @unlink($old);
            }
            $imagePath = 'images/blog/' . $filename;
        }
    }

    if(empty($errors)){
        $u = $mysqli->prepare('UPDATE news SET date_publication = ?, image = ?, title = ?, subtitle = ?, description = ? WHERE id = ?');
        if(!$u) die('Error preparar: ' . $mysqli->error);
        $u->bind_param('sssssi', $date_publication, $imagePath, $title, $subtitle, $description, $id);
        if($u->execute()){
            header('Location: adminNews.php?message=updated');
            exit();
        } else {
            $errors[] = 'Error al actualizar';
        }
    }
}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Noticia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
<div class="container py-4">
    <h1>Editar Noticia</h1>
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input name="title" class="form-control" value="<?php echo htmlspecialchars($_POST['title'] ?? $news['title']); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Subtítulo</label>
            <input name="subtitle" class="form-control" value="<?php echo htmlspecialchars($_POST['subtitle'] ?? $news['subtitle']); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha publicación</label>
            <input name="date_publication" type="date" class="form-control" value="<?php echo htmlspecialchars($_POST['date_publication'] ?? $news['date_publication']); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Imagen (opcional)</label>
            <?php if(!empty($news['image'])): ?>
                <div class="mb-2"><img src="../../theme/<?php echo htmlspecialchars($news['image']); ?>" style="height:80px;border-radius:6px;"></div>
            <?php endif; ?>
            <input name="image" type="file" accept="image/*" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control" rows="6"><?php echo htmlspecialchars($_POST['description'] ?? $news['description']); ?></textarea>
        </div>
        <button class="btn btn-primary">Guardar</button>
        <a href="adminNews.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
