<?php 
session_start();
require_once '../config.php';

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../login.php');
    exit();
}

// Determinar qué consulta ejecutar
$accion = $_GET['accion'] ?? 'menu';
$resultados = [];
$error = '';
$titulo = '';

// PROCESAR FORMULARIOS
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    switch($accion){
        case 'modulos_alumno':
            $email = $_POST['email'];
            $stmt = $mysqli->prepare('
                SELECT 
                    Modulo.nombre,
                    Modulo.foto,
                    Notas.nota,
                    Users.nombre AS alumno_nombre,
                    Users.apellidos AS alumno_apellidos
                FROM Notas
                INNER JOIN Modulo ON Notas.id_modulo = Modulo.id
                INNER JOIN Users ON Notas.id_usuario = Users.id
                WHERE Users.email = ?
            ');
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $resultados = $result->fetch_all(MYSQLI_ASSOC);
            $titulo = !empty($resultados) 
                ? "Módulos de {$resultados[0]['alumno_nombre']} {$resultados[0]['alumno_apellidos']}" 
                : "Sin resultados para: $email";
            break;
            
        case 'notas_alumno':
            $email = $_POST['email'];
            $stmt = $mysqli->prepare('
                SELECT 
                    Modulo.nombre AS modulo,
                    Notas.nota,
                    Users.nombre AS alumno_nombre,
                    Users.apellidos AS alumno_apellidos
                FROM Notas
                INNER JOIN Modulo ON Notas.id_modulo = Modulo.id
                INNER JOIN Users ON Notas.id_usuario = Users.id
                WHERE Users.email = ?
                ORDER BY Modulo.nombre
            ');
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $resultados = $result->fetch_all(MYSQLI_ASSOC);
            $titulo = !empty($resultados) 
                ? "Todas las notas de {$resultados[0]['alumno_nombre']} {$resultados[0]['alumno_apellidos']}" 
                : "Sin resultados para: $email";
            break;
            
        case 'promedio_alumno':
            $email = $_POST['email'];
            $stmt = $mysqli->prepare('
                SELECT 
                    Users.nombre,
                    Users.apellidos,
                    AVG(Notas.nota) AS promedio,
                    COUNT(Notas.id) AS total_modulos
                FROM Notas
                INNER JOIN Users ON Notas.id_usuario = Users.id
                WHERE Users.email = ?
                GROUP BY Users.id
            ');
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $resultados = $result->fetch_all(MYSQLI_ASSOC);
            $titulo = "Promedio General";
            break;
            
        case 'alumnos_modulo':
            $id_modulo = $_POST['id_modulo'];
            $stmt = $mysqli->prepare('
                SELECT 
                    Users.nombre,
                    Users.apellidos,
                    Users.email,
                    Notas.nota,
                    Modulo.nombre AS modulo
                FROM Notas
                INNER JOIN Users ON Notas.id_usuario = Users.id
                INNER JOIN Modulo ON Notas.id_modulo = Modulo.id
                WHERE Modulo.id = ?
                ORDER BY Notas.nota DESC
            ');
            $stmt->bind_param("i", $id_modulo);
            $stmt->execute();
            $result = $stmt->get_result();
            $resultados = $result->fetch_all(MYSQLI_ASSOC);
            $titulo = !empty($resultados) ? "Alumnos de {$resultados[0]['modulo']}" : "Sin resultados";
            break;
            
        case 'nota_alumno_modulo':
            $email = $_POST['email'];
            $id_modulo = $_POST['id_modulo'];
            $stmt = $mysqli->prepare('
                SELECT 
                    Users.nombre,
                    Users.apellidos,
                    Modulo.nombre AS modulo,
                    Notas.nota
                FROM Notas
                INNER JOIN Users ON Notas.id_usuario = Users.id
                INNER JOIN Modulo ON Notas.id_modulo = Modulo.id
                WHERE Users.email = ? AND Modulo.id = ?
            ');
            $stmt->bind_param("si", $email, $id_modulo);
            $stmt->execute();
            $result = $stmt->get_result();
            $resultados = $result->fetch_all(MYSQLI_ASSOC);
            $titulo = "Nota Específica";
            break;
            
        case 'promedios_modulos':
            $stmt = $mysqli->query('
                SELECT 
                    Modulo.nombre AS modulo,
                    AVG(Notas.nota) AS promedio,
                    COUNT(Notas.id) AS total_alumnos,
                    MIN(Notas.nota) AS nota_minima,
                    MAX(Notas.nota) AS nota_maxima
                FROM Notas
                INNER JOIN Modulo ON Notas.id_modulo = Modulo.id
                GROUP BY Modulo.id
                ORDER BY promedio DESC
            ');
            $resultados = $stmt->fetch_all(MYSQLI_ASSOC);
            $titulo = "Promedios por Módulo";
            break;
            
        case 'alumnos_destacados':
            $nota_minima = $_POST['nota_minima'];
            $stmt = $mysqli->prepare('
                SELECT 
                    Users.nombre,
                    Users.apellidos,
                    Users.email,
                    AVG(Notas.nota) AS promedio
                FROM Notas
                INNER JOIN Users ON Notas.id_usuario = Users.id
                GROUP BY Users.id
                HAVING AVG(Notas.nota) >= ?
                ORDER BY promedio DESC
            ');
            $stmt->bind_param("d", $nota_minima);
            $stmt->execute();
            $result = $stmt->get_result();
            $resultados = $result->fetch_all(MYSQLI_ASSOC);
            $titulo = "Alumnos con promedio ≥ $nota_minima";
            break;
    }
}

// Obtener lista de módulos para los selectores
$modulos_list = $mysqli->query("SELECT id, nombre FROM Modulo ORDER BY nombre ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas y Reportes - UAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 0;
        }
        
        .consultas-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
            margin-bottom: 30px;
        }
        
        .header-section {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #667eea;
        }
        
        .header-title {
            margin: 0;
            color: #333;
            font-weight: bold;
        }
        
        .btn-back {
            background: white;
            border: 2px solid #667eea;
            padding: 10px 20px;
            border-radius: 10px;
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        .btn-back:hover {
            background: #667eea;
            color: white;
        }
        
        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-buscar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-buscar:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .resultado-card {
            background: #e8f5e9;
            border-left: 4px solid #4CAF50;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }
        
        .sin-resultados {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
            color: #856404;
        }
        
        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .table tbody tr:hover {
            background: #f8f9fa;
        }
        
        .section-title {
            color: #667eea;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }
        
        .badge-ranking {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 5px 10px;
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="../admin/admin-dashboard.php" class="btn-back">
            <i class="bi bi-arrow-left me-2"></i>
            Volver al Dashboard
        </a>
        
        <div class="consultas-container">
            <div class="header-section">
                <h1 class="header-title">
                    <i class="bi bi-file-bar-graph-fill me-2"></i>
                    Consultas y Reportes
                </h1>
            </div>
            
            <!-- MOSTRAR RESULTADOS -->
            <?php if(!empty($resultados)): ?>
                <div class="resultado-card">
                    <h3 class="mb-3">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <?= htmlspecialchars($titulo) ?>
                    </h3>
                    
                    <?php if($accion === 'modulos_alumno'): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Módulo</th>
                                        <th>Nota</th>
                                        <th>Foto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($resultados as $r): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($r['nombre']) ?></td>
                                        <td><strong><?= htmlspecialchars($r['nota']) ?></strong></td>
                                        <td><img src="<?= htmlspecialchars($r['foto']) ?>" width="50" class="rounded"></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                    <?php elseif($accion === 'notas_alumno'): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Módulo</th>
                                        <th>Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($resultados as $r): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($r['modulo']) ?></td>
                                        <td><strong><?= htmlspecialchars($r['nota']) ?></strong></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                    <?php elseif($accion === 'promedio_alumno'): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Alumno</th>
                                        <th>Promedio</th>
                                        <th>Total Módulos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($resultados as $r): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($r['nombre']) ?> <?= htmlspecialchars($r['apellidos']) ?></td>
                                        <td><span class="badge bg-success fs-6"><?= number_format($r['promedio'], 2) ?></span></td>
                                        <td><?= $r['total_modulos'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                    <?php elseif($accion === 'alumnos_modulo'): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Posición</th>
                                        <th>Alumno</th>
                                        <th>Email</th>
                                        <th>Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $posicion = 1;
                                    foreach($resultados as $r): 
                                    ?>
                                    <tr>
                                        <td><span class="badge badge-ranking"><?= $posicion++ ?></span></td>
                                        <td><?= htmlspecialchars($r['nombre']) ?> <?= htmlspecialchars($r['apellidos']) ?></td>
                                        <td><?= htmlspecialchars($r['email']) ?></td>
                                        <td><strong><?= htmlspecialchars($r['nota']) ?></strong></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                    <?php elseif($accion === 'nota_alumno_modulo'): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Alumno</th>
                                        <th>Módulo</th>
                                        <th>Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($resultados as $r): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($r['nombre']) ?> <?= htmlspecialchars($r['apellidos']) ?></td>
                                        <td><?= htmlspecialchars($r['modulo']) ?></td>
                                        <td><span class="badge bg-primary fs-6"><?= htmlspecialchars($r['nota']) ?></span></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                    <?php elseif($accion === 'promedios_modulos'): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Módulo</th>
                                        <th>Promedio</th>
                                        <th>Alumnos</th>
                                        <th>Nota Mín</th>
                                        <th>Nota Máx</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($resultados as $r): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($r['modulo']) ?></td>
                                        <td><span class="badge bg-success fs-6"><?= number_format($r['promedio'], 2) ?></span></td>
                                        <td><?= $r['total_alumnos'] ?></td>
                                        <td><?= $r['nota_minima'] ?></td>
                                        <td><?= $r['nota_maxima'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                    <?php elseif($accion === 'alumnos_destacados'): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Alumno</th>
                                        <th>Email</th>
                                        <th>Promedio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $ranking = 1;
                                    foreach($resultados as $r): 
                                    ?>
                                    <tr>
                                        <td><span class="badge badge-ranking"><?= $ranking++ ?></span></td>
                                        <td><?= htmlspecialchars($r['nombre']) ?> <?= htmlspecialchars($r['apellidos']) ?></td>
                                        <td><?= htmlspecialchars($r['email']) ?></td>
                                        <td><span class="badge bg-warning text-dark fs-6"><?= number_format($r['promedio'], 2) ?></span></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                
            <?php elseif($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <div class="sin-resultados">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>No se encontraron resultados</strong>
                    <p class="mb-0 mt-2"><?= htmlspecialchars($titulo) ?></p>
                </div>
            <?php endif; ?>
            
            <hr class="my-4">
            
            <!-- FORMULARIOS DE CONSULTA -->
            <h2 class="section-title">
                <i class="bi bi-person-circle me-2"></i>
                Consultas por Alumno
            </h2>
            
            <div class="accordion mb-4" id="accordionAlumno">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#modulos">
                            <i class="bi bi-book-fill me-2"></i>
                            Ver módulos matriculados
                        </button>
                    </h2>
                    <div id="modulos" class="accordion-collapse collapse" data-bs-parent="#accordionAlumno">
                        <div class="accordion-body">
                            <form method="POST" action="?accion=modulos_alumno">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email del alumno:</label>
                                    <input type="email" class="form-control" name="email" placeholder="alumno@uab.cat" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-buscar">
                                    <i class="bi bi-search me-2"></i>
                                    Buscar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#notas">
                            <i class="bi bi-journal-text me-2"></i>
                            Ver todas las notas de un alumno
                        </button>
                    </h2>
                    <div id="notas" class="accordion-collapse collapse" data-bs-parent="#accordionAlumno">
                        <div class="accordion-body">
                            <form method="POST" action="?accion=notas_alumno">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email del alumno:</label>
                                    <input type="email" class="form-control" name="email" placeholder="alumno@uab.cat" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-buscar">
                                    <i class="bi bi-search me-2"></i>
                                    Buscar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#promedio">
                            <i class="bi bi-calculator me-2"></i>
                            Ver promedio general
                        </button>
                    </h2>
                    <div id="promedio" class="accordion-collapse collapse" data-bs-parent="#accordionAlumno">
                        <div class="accordion-body">
                            <form method="POST" action="?accion=promedio_alumno">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email del alumno:</label>
                                    <input type="email" class="form-control" name="email" placeholder="alumno@uab.cat" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-buscar">
                                    <i class="bi bi-search me-2"></i>
                                    Buscar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#notaModulo">
                            <i class="bi bi-file-earmark-text me-2"></i>
                            Ver nota en un módulo específico
                        </button>
                    </h2>
                    <div id="notaModulo" class="accordion-collapse collapse" data-bs-parent="#accordionAlumno">
                        <div class="accordion-body">
                            <form method="POST" action="?accion=nota_alumno_modulo">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email del alumno:</label>
                                    <input type="email" class="form-control" name="email" placeholder="alumno@uab.cat" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Módulo:</label>
                                    <select class="form-select" name="id_modulo" required>
                                        <option value="">Selecciona un módulo</option>
                                        <?php 
                                        $modulos_list->data_seek(0);
                                        while($mod = $modulos_list->fetch_assoc()): 
                                        ?>
                                            <option value="<?= $mod['id'] ?>"><?= htmlspecialchars($mod['nombre']) ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-buscar">
                                    <i class="bi bi-search me-2"></i>
                                    Buscar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <h2 class="section-title">
                <i class="bi bi-bookmark-fill me-2"></i>
                Consultas por Módulo
            </h2>
            
            <div class="accordion mb-4" id="accordionModulo">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#alumnosModulo">
                            <i class="bi bi-people-fill me-2"></i>
                            Ver alumnos de un módulo
                        </button>
                    </h2>
                    <div id="alumnosModulo" class="accordion-collapse collapse" data-bs-parent="#accordionModulo">
                        <div class="accordion-body">
                            <form method="POST" action="?accion=alumnos_modulo">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Módulo:</label>
                                    <select class="form-select" name="id_modulo" required>
                                        <option value="">Selecciona un módulo</option>
                                        <?php 
                                        $modulos_list->data_seek(0);
                                        while($mod = $modulos_list->fetch_assoc()): 
                                        ?>
                                            <option value="<?= $mod['id'] ?>"><?= htmlspecialchars($mod['nombre']) ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-buscar">
                                    <i class="bi bi-search me-2"></i>
                                    Ver
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <h2 class="section-title">
                <i class="bi bi-bar-chart-fill me-2"></i>
                Estadísticas Generales
            </h2>
            
            <div class="accordion" id="accordionEstadisticas">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#promediosModulos">
                            <i class="bi bi-graph-up me-2"></i>
                            Promedios por módulo
                        </button>
                    </h2>
                    <div id="promediosModulos" class="accordion-collapse collapse" data-bs-parent="#accordionEstadisticas">
                        <div class="accordion-body">
                            <form method="POST" action="?accion=promedios_modulos">
                                <button type="submit" class="btn btn-primary btn-buscar">
                                    <i class="bi bi-file-bar-graph me-2"></i>
                                    Ver estadísticas
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#destacados">
                            <i class="bi bi-star-fill me-2"></i>
                            Alumnos destacados
                        </button>
                    </h2>
                    <div id="destacados" class="accordion-collapse collapse" data-bs-parent="#accordionEstadisticas">
                        <div class="accordion-body">
                            <form method="POST" action="?accion=alumnos_destacados">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nota mínima promedio:</label>
                                    <input type="number" class="form-control" step="0.01" name="nota_minima" value="7.0" min="0" max="10" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-buscar">
                                    <i class="bi bi-search me-2"></i>
                                    Buscar alumnos
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>