<?php

require_once 'Api.php';

// Instancier la classe Api
$api = new Mymi\Opensource\Api();

// Appeler la méthode scrapApi() pour récupérer les informations des mangas
$data = $api->scrapApi();

// Afficher les données des mangas
foreach ($data as $manga) {
    echo "Titre : " . $manga['title'] . "<br>";
    echo "Image : <img src='" . $manga['image'] . "'><br>";
    echo "Description : " . $manga['description'] . "<br>";
    echo "Genre : " . $manga['genre'] . "<br>";
    echo "Note : " . $manga['note'] . "<br>";
    echo "<hr>";
}

?>