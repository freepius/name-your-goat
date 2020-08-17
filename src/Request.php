<?php

namespace NameYourGoat;

class Request
{
    /**
     * Return the method of the current request, in lowercase.
     */
    public static function method() : string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Return the value of a GET data.
     * The value is cleaned and secured.
     * If the GET data doesn't exist, throw an exception!
     */
    public static function get(string $key)
    {
        if (! isset($_GET[$key])) {
            throw new \ErrorException("The GET data '$key' does not exist.");
        }

        return htmlspecialchars(stripslashes(trim($_GET[$key])));
    }
     
    /**
     * Return the value of a POST data.
     * The value is cleaned and secured.
     * If the POST data doesn't exist, throw an exception!
     */
    public static function post(string $key)
    {
        if (! isset($_POST[$key])) {
            throw new \ErrorException("The POST data '$key' does not exist.");
        }

        return htmlspecialchars(stripslashes(trim($_POST[$key])));
    }

    /**
     * Return the route of the current request.
     * Return an empty string ('') for the main route.
     */
    public static function route() : string
    {
        return isset($_SERVER['PATH_INFO'])  ?
            substr($_SERVER['PATH_INFO'], 1) :
            '';
    }
}
