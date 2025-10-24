<?php
session_start();

if(!isset($_SESSION['personajes'])){
    $_SESSION['personajes'] = 
        [
            "id" => 0,
            "nombre" => "Iron Man",
            "imagen" => "https://snapjson.untapped.gg/art/render/framebreak/common/512/IronMan.webp",
            "poder" => "volar",
            "descripcion" => "Tony Startk en modo robot"
        ];
}

// funcion para añadir personajes (create en bbdd)

function agregarPersonaje($nombre, $imagen, $poder, $desc){
    array_push($_SESSION['personajes'], 
        [
            "nombre" => $nombre,
            "imagen" => $imagen,
            "poder" => $poder,
            "descripcion" => $desc
        ]
        );
} 

// Editar personaje

function editarPersonaje($id, $nombre, $imagen, $poder, $desc){
    //Comprovamos id
    if(isset($_SESSION['personajes'][$id])){
        $_SESSION['personajes'][$id] = [
            "nombre" => $nombre,
            "imagen" => $imagen,
            "poder" => $poder,
            "descripcion" => $desc
        ];
    }
}

?>