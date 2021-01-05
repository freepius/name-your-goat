<?php

namespace NameYourGoat\Repository;

class User
{
    // Used to keep the data in memory
    protected static array $users = [];

    /**
     * Return an array of [ID => user]
     * where a user is an object of {
     *   token, name, locale
     * }
     */
    public static function all() : array
    {
        if (self::$users) {
            return self::$users;
        }

        $attrs = ['token', 'name', 'locale'];

        return self::$users = array_map(
            fn(array $user) => (object) array_combine($attrs, $user),
            include __DIR__.'/../data/users.php'
        );
    }

    public static function byToken(string $token) : ?object
    {
        $users = self::all();

        foreach ($users as $user) {
            if ($token === (string) $user->token) {
                return $user;
            }
        }

        return null;
    }
}
