<?php namespace Midday;

spl_autoload_register('Midday\AutoLoader::loader');

class AutoLoader
{
    public static function loader($className)
    {
        require_once str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    }
}
