<?php
    session_start();
    $noticia = $_SESSION['noticias'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Noticias</title>
</head>
<body>
<?php
    include_once 'inc/header.php';
?>

<main>

<section class="news-grid-display">

    <?php
        foreach ($noticia as $noticias) {
            echo '<article class="new-item">';
            echo "<h2>{$noticias['title']}</h2>";
            echo "<p><em>{$noticias['date']} - {$noticias['category']}</em></p>";
            echo "<img src='{$noticias['image']}' alt='{$noticias['title']}' width='300'>";
            echo "<p>{$noticias['content']}</p>";
            echo "</article>";
        }

        // print_r($_SESSION); para ver que hay guardado en la sesion
    ?>

</section>

<a href="logout.php"><button>Logout</button></a>

</main>
<?php
    include_once 'inc/footer.php';
?>

</body>
</html>