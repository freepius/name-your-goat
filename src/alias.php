<?php

function locale(string $locale) : bool
{
    return $locale === NameYourGoat\User::locale();
}

function ldate(string $date) : string
{
    return (new \DateTime($date))->format([
        'en' => 'Y-m-d',
        'fr' => 'd/m/Y',
    ][NameYourGoat\User::locale()]);
}

function render(string $file, array $vars = [])
{
    extract($vars);
    require __DIR__.'/view/'.$file.'.php';
}

/************************************************
 * TRANSLATOR alias
 ***********************************************/

/**
 * Pure alias to the NameYourGoat\Translator::trans() function.
 */
function _t(string $domain, string $key, $args = [], bool $keyIsDefault = false)
{
    return NameYourGoat\Translator::trans($domain, $key, $args, $keyIsDefault);
}

/**
 * Translation on the 'main' domain.
 */
function t(string $key, $args = [], bool $keyIsDefault = false) : string
{
    return NameYourGoat\Translator::trans('main', $key, $args, $keyIsDefault);
}

/**
 * Translation on the 'local' domain (ie, the calling view)
 */
function tl(string $key, $args = [], bool $keyIsDefault = false) : string
{
    $domain = basename(debug_backtrace()[0]['file'], '.php');

    return NameYourGoat\Translator::trans($domain, $key, $args, $keyIsDefault);
}

/**
 * Translation on the 'goat' domain.
 */
function tg(string $key, $args = [], bool $keyIsDefault = false) : string
{
    return NameYourGoat\Translator::trans('goat', $key, $args, $keyIsDefault);
}

/************************************************
 * USER alias
 ***********************************************/

function isAuth() : bool
{
    return NameYourGoat\User::isAuth();
}
