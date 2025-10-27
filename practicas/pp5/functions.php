<?php
session_start();

function editarLibro($id, $titulo, $autor, $desc, $img){
    if(isset($_SESSION['libros'][$id])){
        $_SESSION['libros'][$id] = [
            'titulo' => $titulo,
            'autor' => $autor,
            'desc' => $desc,
            'img' => $img,
        ];
    }
}

function crearLibro($titulo, $autor, $desc, $img){
    array_push($_SESSION['libros'],
    [
        'titulo' => $titulo,
        'autor' => $autor,
        'desc' => $desc,
        'img' => $img
    ]
);
}

function eliminarLibro($id){
    if(isset($_SESSION['libros'][$id])){
        unset($_SESSION['libros'][$id]);
        $_SESSION['libros'] = array_values($_SESSION['libros']);
    }
}

