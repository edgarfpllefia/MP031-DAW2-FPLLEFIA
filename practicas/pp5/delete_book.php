<?php 
session_start();

require_once 'functions.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    if(isset($_SESSION['libros'][$id])){
        eliminarLibro($id);
    }
    header('Location: home.php');
}
