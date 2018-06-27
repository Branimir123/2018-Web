<?php
class Startup
{
    public static function _init(bool $isController = NUL)
    {
        self::_configurePaths($isController);
        spl_autoload_register(function($className)
        {
            $path = $_SERVER['DOCUMENT_ROOT'] . '/2018-Web/src/' . $className . '.php';
            
            $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);

            echo $path;
            
            require_once $path;
        });
    }
    
    public static function _configurePaths(bool $isController)
    {
        $basePath = $isController ? '../' : '';
        $config   = parse_ini_file("${basePath}config/config.ini", true);
        define('CONFIG', $config);
    }
} 