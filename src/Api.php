<?php

declare(strict_types=1);

namespace Mymi\Opensource;

use Goutte\Client;

class Api {
    public function scrapApi(){
        $url = 'https://www.ledojomanga.com/anime';

        $client = new Client();
        $crawler = $client->request('GET', $url);

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

        // Retourner les données des mangas
        return $mangas;
    }
}
?>