<?php
session_start();
require_once('../../theme/config.php');

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: ../../login.php');
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM testimonials WHERE id = $id";

if($mysqli->query($sql)){
    header('Location: adminTestimonials.php');
} else {
    header('Location: adminTestimonials.php');
}
exit();
?>