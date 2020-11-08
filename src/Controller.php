<?php

namespace NameYourGoat;

class Controller
{
    public static function mainPage() : void
    {
        $user = User::auth();

        $colsNum = 6;
        $goatsByCol = [];

        $goats = Repository\Goat::all();
        shuffle($goats);

        $i = $countNoNamedGoats = 0;

        foreach ($goats as $goat) {
            if (! $goat->name) {
                $countNoNamedGoats++;
            }

            $goatsByCol[$i++ % $colsNum][] = $goat;
        }

        require 'view/main.php';
    }

    public static function auth() : void
    {
        try {
            User::authCookie(Request::get('token'));
            header('Location: /');
        } catch (\ErrorException $e) {
            throw $e;
        }
    }

    public static function giveName() : void
    {
        $user = User::auth();

        if (! User::isAuth()) {
            throw new \ErrorException('Your are not allowed to name a goat.');
        }

        if ($user->goatNamed) {
            throw new \ErrorException('Your already named a goat. You can\'t name a second one.');
        }

        $id    = Request::post('id');
        $name  = Request::post('name');
        $theme = Request::post('theme');

        $goats = Repository\Goat::all();

        if (! $goat = $goats[$id] ?? null) {
            throw new \ErrorException("The goat '$id' does not exist.");
        }

        if ($goat->name) {
            throw new \ErrorException("The goat '$id' already has a name ({$goat->name}).");
        }

        if (!$name || !$theme) {
            throw new \ErrorException("The name and/or the theme is empty. You must enter both for the goat.");
        }

        Repository\Proposal::do($user, $goat, $name, $theme);

        render('proposal-done', ['goat' => $goat->ID, 'user' => $user->name]);
    }

    public static function locale(string $locale) : void
    {
        User::localeCookie($locale);
        header('Location: /');
    }
}
