<?php

namespace NameYourGoat;

class Translator
{
    public const KEY_MUST_EXIST = true;

    // All the texts lazy loaded, ordered by "domain.locale"
    protected static array $texts = [];

    public static function trans(
        string $domain,
        string $key,
        $args = [],
        bool $keyIsDefault = false
    ) {
        $domain .= '.'.User::locale();
        $originalKey = $key;
        $args = (array) $args;

        // If necessary, load the "domain.locale" translation file
        if (! in_array($domain, self::$texts)) {
            self::$texts[$domain] = require "trans/$domain.php";
        }

        // First we search for the full key (not decomposed).
        $trans = self::$texts[$domain][$key] ?? null;

        /**
         * If no translation exists for it, we try all the decompositions.
         * For eg, if $key is 'my-section.my-sub.title.2',
         * we will search  in ['my-section']['my-sub.title.2'],
         * then            in ['my-section']['my-sub']['title.2'],
         * finally         in ['my-section']['my-sub']['title']['2'].
         */
        $arr =& self::$texts[$domain];

        do {
            if (null !== $trans) {
                break;
            }

            $parent = strtok($key, '.');
            $key = strtok('');

            if (false === $key || !isset($arr[$parent])) {
                $key = $parent;
                break;
            }

            $arr =& $arr[$parent];

            $trans = $arr[$key] ?? null;
        } while (1);
        
        if (true === $trans || (null === $trans && $keyIsDefault)) {
            $trans = $key;
        }

        if (null === $trans && self::KEY_MUST_EXIST) {
            throw new \ErrorException(
                "The translation key '$originalKey' does not exist in the domain '$domain'."
            );
        }

        if (is_array($trans)) {
            throw new \ErrorException(
                "The translation key '$originalKey' has child translations. ".
                "You have to choose one."
            );
        }

        if ($trans instanceof \Closure) {
            $trans = $trans(...$args);
        }

        $trans = (string) $trans;

        /**
         * We try to replace some patterns (%0, %1, %2, %aKey, %anotherKey...)
         * by the given arguments ($args).
         */
        foreach ($args as $i => $arg) {
            $trans = str_replace("%$i", $arg, $trans);
        }

        return $trans;
    }
}
