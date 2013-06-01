<?php
class AutoLoader
{
    private static $classNames = array();

    /**
     * Store the filename, without extension, of all .php files found
     */
    public static function registerDirectory($dirName)
    {
        $di = new DirectoryIterator($dirName);
        foreach ($di as $file) {
            if ($file->isDir() && !$file->isLink() && !$file->isDot()) {
                self::registerDirectory($file->getPathName());
            } elseif (substr($file->getFilename(), -4 === '.php')) {
                $className = substr($file->getFilename(), 0, -4);
                AutoLoader::registerClass($className, $file->getPathname());
            }
        }
    }
    /**
     * Register source file name for each class found
     *
     * @param string $className Class Name
     * @param string $fileName Class Source File Name
     */
    public static function registerClass($className, $fileName)
    {
        AutoLoader::$classNames[$className] = $fileName;
    }

    /**
     * Load the class source
     *
     * @param string $className Name of class to load
     */
    public static function loadClass($className)
    {
        if (isset(AutoLoader::$classNames[$className])) {
            require_once(AutoLoader::$classNames[$className]);
        }
    }
}

spl_autoload_register(array('AutoLoader', 'loadClass'));