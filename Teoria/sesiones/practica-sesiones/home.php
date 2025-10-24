<?php 
session_start();

$nombre = $_SESSION['name'];

echo "<h1>Hola" .$nombre."</h1>
<form action='personajes.php' method='POST'>
    <label for='person'></label>
    <input type='text' name=''>
    <label for='url'></label>
    <input type='url' name='url'>
    <input type='submit' value='Enviar'>
</form>";

?>