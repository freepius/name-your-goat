<?php

return [
    "head.title" => fn(bool $auth) => $auth
        ? "Name your goat"
        : "Face'Goats",

    "title" => "Welcome on the Roze&#8239;&&#8239;Mathieu's <i>Face'Goats</i>",

    "subtitle" => fn(bool $auth) => $auth
        ? "Help us to name our goats!"
        : "Discover our pretty goats!",
    
    "subtitle.hello" => "Hello <u>%0</u>!",

    "Close" => true,
    "My language:" => true,

    "the-place" => [
        "title" => "The place",
    ],

    "the-farm" => [
        "title" => "On our pretty little farm, we&nbsp;have...",
        'chickens' => 'Our 3 pretty chickens: Conquistador (the white), Martine (the black) and Larousse (the red)',
        'droppie' => 'Droppie, a <i>Pyrenean Shepherd</i>, our future herd dog',
        'bees' => 'Our first little beehive. The colony is doing well!',
        'farmers' => 'It\'s us ! Roze et Mathieu :-)',
    ],

    "main" => [
        "title" => "Our 26 goats and 2 billy goats",
        "help" => "(click on a goat's photo for more info)",
    ]
];
