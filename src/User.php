<?php

namespace NameYourGoat;

class User
{
    public const AVAILABLE_LOCALES = ['en', 'fr'];

    public static string $defaultLocale = 'en';

    protected static string $locale = '';

    protected static ?object $fullUser = null;

   /**
     * If the current user exists in the "Authorized users" list, return the full information about him.
     * Otherwise, return null.
     */
    public static function auth() : ?object
    {
        // Retrieve the "full user" just one time
        if (self::$fullUser) {
            return self::$fullUser;
        }

        if (! $token = $_COOKIE['NameYourGoat_User_Token'] ?? null) {
            return null;
        }

        if (! $user = Repository\User::byToken($token)) {
            setcookie('NameYourGoat_User_Token', null, 0, '/');
            return null;
        }

        self::authCookie($token);

        return self::$fullUser = $user;
    }

    /**
     * Write a user's token in a cookie without any checks.
     */
    public static function authCookie(string $token) : void
    {
        setcookie('NameYourGoat_User_Token', $token, time() + 3600*24*30, '/');
    }

    /**
     * Is the current user allowed to name a goat?
     */
    public static function isAuth() : bool
    {
        return null !== self::$fullUser;
    }

    /**
     * Return the locale for the current user.
     * 1) Search in cookies (because the user can set himself the locale).
     * 2) If user is authorized, return its stored locale.
     * 3) If not, search in the headers of the user request.
     * 4) Otherwise return the default locale.
     */
    public static function locale() : string
    {
        // Compute the locale just one time
        if (self::$locale) {
            return self::$locale;
        }

        // Lang in cookies
        $locale = self::langToLocale($_COOKIE['NameYourGoat_User_Locale'] ?? '');

        // Lang in User repository
        if (! $locale && self::isAuth()) {
            $locale = self::langToLocale(self::$fullUser->lang);
        }

        // Lang in the request headers
        if (! $locale) {
            $acceptLang = explode(',', getallheaders()['Accept-Language'] ?? '');

            foreach ($acceptLang as $lang) {
                if ($locale = self::langToLocale(trim(strtok($lang, '-;')))) {
                    break;
                }
            }
        }

        return self::$locale = $locale ?: self::$defaultLocale;
    }

    /**
     * Write a user's locale in a cookie.
     */
    public static function localeCookie(string $locale) : void
    {
        setcookie('NameYourGoat_User_Locale', self::langToLocale($locale), time() + 3600*24*30, '/');
    }

    /**
     * From a given language, return the corresponding locale in this application.
     * Otherwise, return an empty string.
     */
    protected static function langToLocale(string $lang) : string
    {
        return
            ['nl' => 'en'][$lang] ??
            (in_array($lang, self::AVAILABLE_LOCALES)
                ? $lang
                : ''
            );
    }
}
