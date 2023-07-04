<?php
declare(strict_types=1);

namespace Mymi\Opensource;
require_once '../vendor/autoload.php';

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

class Api {
    public function scrapApi() {
        $url = 'https://www.ledojomanga.com/anime';

        $browser = new HttpBrowser(HttpClient::create());

        $crawler = $browser->request('GET', $url);

        $mangas = [];

        $selector = '.anime-fiche';

        // Parcourir tous les éléments des mangas
        $crawler->filter($selector)->each(function ($node) use (&$mangas) {
            $title = $node->filter('.h3.Ma0.inline-block')->text();
            $image = $node->filter('.anime-affiche > img')->attr('src');
            $description = $node->filter('.bloc_texte')->text();
            $genre = $node->filter('.anime-genre')->text();
            $note = $node->filter('.nmbr .total')->text();

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
?>