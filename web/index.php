<?php

namespace NameYourGoat;

require "../src/autoload.php";
require "../src/config.php";
require "../src/alias.php";

$route = Request::route();
$method = Request::method();

if ('' === $route) {
    Controller::mainPage();
} elseif ('auth' === $route) {
    Controller::auth();
} elseif ('give-a-name' === $route && 'post' === $method) {
    Controller::giveName();
} elseif ('locale/fr' === $route || 'locale/en' === $route) {
    Controller::locale(substr($route, -2));
} else {
    header('Location: /');
}
