<?php

return [
    "head.title" => fn(bool $auth) => $auth
        ? "Nomme ta chèvre"
        : "Trombino'chèvres",

    "title" => "Bienvenue sur le trombino'chèvres de Roze&#8239;et&#8239;Mathieu",

    "subtitle" => fn(bool $auth) => $auth
        ? "Aide-nous à nommer nos chèvres&nbsp;!"
        : "Découvre nos belles chèvres&nbsp;!",

    "subtitle.hello" => "Salut <u>%0</u> !",

    "Close" => "Fermer",
    "My language:" => "Ma langue :",

    "the-place" => [
        "title" => "Le lieu",
    ],

    "the-farm" => [
        "title" => "Sur notre jolie p'tite ferme, on&nbsp;a...",
    ],

    "gallery" => [
        'chickens' => 'Nos 3 belles poules : Conquistador (la blanche), Martine (la noire) et Larousse (la rousse)',
        'droppie' => 'Droppie, une <i>bergère des Pyrénées</i>, notre future chienne de troupeau',
        'bees' => 'Notre première petite ruche. La colonnie se porte bien !',
        'farmers' => 'C\'est nous ! Roze et Mathieu :-)',
    ],

    "main" => [
        "title" => "Nos 26 chèvres et 2 boucs",
        "help" => "(clique sur la photo d'une chèvre pour avoir plus d'infos)",
    ]
];
