<?php

const PARENT_NAMESPACE = 'NameYourGoat';

const AVAILABLE_CLASSES = [
    'Controller', 'Request', 'Translator', 'User',
    'Repository\\Goat',
    'Repository\\Proposal',
    'Repository\\User',
];

spl_autoload_register(function ($class) {
    $namespace = strtok($class, '\\');
    $class = strtok('');

    if ($namespace === PARENT_NAMESPACE && in_array($class, AVAILABLE_CLASSES)) {
        require str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
        return true;
    }
    return false;
});
