<?php
session_start();
require_once('../theme/config.php');

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../login.php');
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM projects WHERE id = $id";

if($mysqli->query($sql)){
    header('Location: adminProjects.php');
} else {
    header('Location: adminProjects.php');
}
exit();
?>