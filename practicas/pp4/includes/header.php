<?php
echo "
<header style='
    display:flex; 
    align-items:center; 
    gap:20px; 
    padding:15px 25px; 
    background:#f8f9fa;
    box-shadow: 0 2px 3px;
    font-family: Arial, sans-serif;
'>
    <img src='".$foto."' alt='Foto de perfil' style='
        width:80px; 
        height:80px; 
        border-radius:50%; 
        object-fit:cover; 
        border:2px solid #ccc;
    '>
    <h1 style='margin:0; font-size:1.8rem; color:#333;'>Bienvenido ".$nombre."</h1>
</header>";
?>