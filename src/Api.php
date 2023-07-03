<?php
declare(strict_types=1);

namespace Mymi\Opensource;
require_once 'vendor/autoload.php';

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

class Api {
    public function scrapApi() {
        $url = 'https://www.ledojomanga.com/anime';

        // Crée une instance de HttpBrowser
        $browser = new HttpBrowser(HttpClient::create());

        // Accède à l'URL spécifiée
        $crawler = $browser->request('GET', $url);

        // Tableau pour stocker les données des mangas
        $mangas = [];

        // Sélecteur CSS pour les éléments des mangas
        $selector = '.anime-fiche';

        // Parcourir tous les éléments des mangas
        $crawler->filter($selector)->each(function ($node) use (&$mangas) {
            $title = $node->filter('.anime-titre > h3')->text();
            $image = $node->filter('.anime-affiche > img')->attr('src');
            $description = $node->filter('.anime-description')->text();
            $genre = $node->filter('.anime-genre')->text();
            $note = $node->filter('.anime-note')->text();

            // Ajouter les données du manga au tableau
            $mangas[] = [
                'title' => $title,
                'image' => $image,
                'description' => $description,
                'genre' => $genre,
                'note' => $note,
            ];
        });

        return $mangas;
    }
}

// Instantiate the Api class
$api = new Api();

// Call the scrapApi() method to retrieve manga information
$data = $api->scrapApi();

// Display manga information
foreach ($data as $manga) {
    echo "Title: " . $manga['title'] . "\n";
    echo "Image: " . $manga['image'] . "\n";
    echo "Description: " . $manga['description'] . "\n";
    echo "Genre: " . $manga['genre'] . "\n";
    echo "Note: " . $manga['note'] . "\n";
    echo "----------------------------------\n";
}
?>