<?php 
    session_start();

    echo 'Sesion iniciada con éxito';
    echo '<br>';
    echo 'Usuario: ' .$_SESSION['user'];
    echo '<br>';
    echo 'Rol: ' .$_SESSION['role'];
    echo '<br>';

    ?>