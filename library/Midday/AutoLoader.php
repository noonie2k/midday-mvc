<?php namespace Midday;

spl_autoload_register('Midday\AutoLoader::loader');

class AutoLoader
{
    public static function loader($className)
    {
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        if (stream_resolve_include_path($fileName)) {
            require_once $fileName;
        } else {
            var_dump($fileName, get_include_path());
            throw new AutoLoader\Exception('Class not found - ' . $className);
        }
    }
}
