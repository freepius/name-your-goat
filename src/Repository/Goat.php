<?php

namespace NameYourGoat\Repository;

class Goat
{
    // Used to keep the data in memory
    protected static array $goats = [];

    /**
     * Return an array of [ID => goat]
     * where a goat is an object of {
     *   ID, godparent, themeOfName, name, birthyear, birthday, breed, motherName, pictures
     * }
     */
    public static function all() : array
    {
        if (self::$goats) {
            return self::$goats;
        }

        $attrs = ['godparent', 'themeOfName', 'name', 'birthyear', 'birthday', 'breed', 'motherName'];

        $goats = include __DIR__.'/../data/goats.php';

        array_walk($goats, function (&$goat, string $id) use ($attrs) {
            $goat = (object) array_combine($attrs, $goat);

            $goat->ID = $id;

            // Get the eventual pictures of the current goat
            $goat->pictures = self::pictures($goat->ID);
        });

        return self::$goats = $goats;
    }

    protected static function pictures(string $ID) : array
    {
        $dir = __DIR__."/../../web/goats/$ID/";

        if (! is_dir($dir)) {
            return [];
        }

        $checkPic = fn ($f) =>
            is_file($dir.$f)
            && $f !== 'thumb.jpg'
            && pathinfo($f, PATHINFO_EXTENSION) === 'jpg';

        return array_filter(scandir($dir), $checkPic);
    }
}
