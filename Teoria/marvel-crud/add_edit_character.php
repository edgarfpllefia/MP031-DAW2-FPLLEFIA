<!-- Formulario para añadir o editar personajes -->

<?php
session_start();

require_once "function.php";

//primer paso - Comprobar si venimos para editar o para añadir

$editMode = false; //Nos dice que estamos editando o añadiendo
$id = null;
$nombre = $imagen = $poder = $desc = "";

//Si hay un id en la url estamos editando.

if(isset($_GET['id'])){
    $id = $_GET['id'];

    if(isset($_SESSION['personajes'][$id])){
        $editMode = true;
        $personajes = $_SESSION['personajes'][$id];

        $nombre = $personaje['nombre'];
        $imagen = $personaje['imagen'];
        $poder = $personaje['poder'];
        $desc = $personaje['descripcion'];
    }
}

//Segundo paso: Procesar el form (POST)

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $nombre = $_POST['nombre'];
    $imagen = $_POST['imagen'];
    $poder = $_POST['poder'];
    $desc = $_POST['descripcion'];
}

if($editMode){
    editarPersonaje($nombre, $imagen, $poder, $desc);
}else{
    agregarPersonaje()
}
