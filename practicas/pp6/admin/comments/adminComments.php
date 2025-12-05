<?php
session_start();
require_once('../../theme/config.php');

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../../login.php');
    exit();
}

$sql = "SELECT
    c.id,
    c.user_id,
    c.content_type,
    c.content_id,
    c.comment,
    c.created_at,
    c.status,
    u.name AS user_name,
    u.email AS user_email,
    COALESCE(n.title, p.title) AS content_title
FROM comments c
LEFT JOIN users u ON c.user_id = u.id
LEFT JOIN news n ON (c.content_type = 'news' AND c.content_id = n.id)
LEFT JOIN projects p ON (c.content_type = 'project' AND c.content_id = p.id)
ORDER BY c.created_at DESC";

$stmt = $mysqli->prepare($sql);
if(!$stmt) {
    die('Error al preparar la consulta: ' . $mysqli->error);
}

$stmt->execute();
$result = $stmt->get_result();
$comments = $result->fetch_all(MYSQLI_ASSOC);

$user_name = $_SESSION['user_name'] ?? 'Admin';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Comentarios - Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #1a1a1a;
            color: #e0e0e0;
        }

        .container-fluid {
            padding: 40px 20px;
        }

        .header {
            margin-bottom: 40px;
            border-bottom: 2px solid rgba(255, 94, 0, 0.3);
            padding-bottom: 20px;
        }

        .header h1 {
            color: #ff5e00;
            font-weight: 700;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff5e00 0%, #d84e00 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #d84e00 0%, #b83e00 100%);
        }

        .table {
            background: rgba(30, 30, 30, 0.98);
            border: 1px solid rgba(255, 94, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead {
            background: rgba(255, 94, 0, 0.1);
            border-bottom: 2px solid rgba(255, 94, 0, 0.3);
        }

        .table th {
            color: #ff5e00;
            font-weight: 600;
            padding: 15px;
        }

        .table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 94, 0, 0.1);
        }

        .table tbody tr:hover {
            background: rgba(255, 94, 0, 0.05);
        }

        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: 600;
        }

        .badge-pending {
            background: rgba(255, 94, 0, 0.3);
            color: #ff5e00;
        }

        .badge-approved {
            background: rgba(76, 175, 80, 0.3);
            color: #4caf50;
        }

        .badge-rejected {
            background: rgba(244, 67, 54, 0.3);
            color: #f44336;
        }

        .btn-sm {
            padding: 5px 10px;
            margin: 0 2px;
        }

        .btn-approve {
            background: #4caf50;
            color: white;
            border: none;
        }

        .btn-approve:hover {
            background: #45a049;
            color: white;
        }

        .btn-reject {
            background: #f44336;
            color: white;
            border: none;
        }

        .btn-reject:hover {
            background: #da190b;
            color: white;
        }

        .btn-delete {
            background: #9c27b0;
            color: white;
            border: none;
        }

        .btn-delete:hover {
            background: #7b1fa2;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state i {
            font-size: 48px;
            color: rgba(255, 94, 0, 0.3);
            margin-bottom: 20px;
        }

        .text-truncate-custom {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .back-link {
            color: #ff5e00;
            text-decoration: none;
            margin-bottom: 20px;
            display: inline-block;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <a href="../panelAdmin.php" class="back-link"><i class="fas fa-arrow-left"></i> Volver al Panel</a>
        
        <div class="header">
            <h1><i class="fas fa-comments"></i> Gestión de Comentarios</h1>
        </div>

        <?php if(empty($comments)): ?>
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>No hay comentarios</h3>
                <p>Todos los comentarios han sido gestionados</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-user"></i> Usuario</th>
                            <th><i class="fas fa-newspaper"></i> Noticia</th>
                            <th><i class="fas fa-comment"></i> Comentario</th>
                            <th><i class="fas fa-calendar"></i> Fecha</th>
                            <th><i class="fas fa-check-circle"></i> Estado</th>
                            <th><i class="fas fa-cog"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($comments as $comment): ?>
                            <tr>
                                <td>
                                    <strong><?php echo htmlspecialchars($comment['user_name'] ?? 'Anónimo'); ?></strong>
                                    <br>
                                    <small><?php echo htmlspecialchars($comment['user_email'] ?? ''); ?></small>
                                </td>
                                <td>
                                    <?php
                                        $ctype = $comment['content_type'] ?? '';
                                        $ctitle = $comment['content_title'] ?? ($ctype ? ucfirst($ctype) . ' eliminado' : '—');
                                        $cid = $comment['content_id'] ?? null;
                                        $link = '#';
                                        if($ctype === 'news'){
                                            $link = "../../theme/blog-single.php?id=" . urlencode($cid);
                                        } elseif($ctype === 'project'){
                                            $link = "../../theme/works.php?id=" . urlencode($cid);
                                        }
                                    ?>
                                    <div>
                                        <small class="text-muted"><?php echo htmlspecialchars(ucfirst($ctype)); ?></small>
                                        <br>
                                        <a href="<?php echo htmlspecialchars($link); ?>" target="_blank">
                                            <?php echo htmlspecialchars($ctitle); ?>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-truncate-custom" title="<?php echo htmlspecialchars($comment['comment']); ?>">
                                        <?php echo htmlspecialchars($comment['comment']); ?>
                                    </div>
                                </td>
                                <td>
                                    <small><?php echo date('d/m/Y H:i', strtotime($comment['created_at'])); ?></small>
                                </td>
                                <td>
                                    <?php 
                                    $status = $comment['status'] ?? 'pending';
                                    $badge_class = 'badge-pending';
                                    $status_text = 'Pendiente';
                                    
                                    if($status == 'approved') {
                                        $badge_class = 'badge-approved';
                                        $status_text = 'Aprobado';
                                    } elseif($status == 'rejected') {
                                        $badge_class = 'badge-rejected';
                                        $status_text = 'Rechazado';
                                    }
                                    ?>
                                    <span class="badge <?php echo $badge_class; ?>"><?php echo $status_text; ?></span>
                                </td>
                                <td>
                                    <a href="approveComment.php?id=<?php echo htmlspecialchars($comment['id']); ?>" class="btn btn-sm btn-approve" title="Aprobar">
                                        <i class="fas fa-check"></i> Aprobar
                                    </a>
                                    <a href="rejectComment.php?id=<?php echo htmlspecialchars($comment['id']); ?>" class="btn btn-sm btn-reject" title="Rechazar">
                                        <i class="fas fa-times"></i> Rechazar
                                    </a>
                                    <a href="deleteComment.php?id=<?php echo htmlspecialchars($comment['id']); ?>" class="btn btn-sm btn-delete" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este comentario?');">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
