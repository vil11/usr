<?php

class legionAutoloader
{
    public static function autoload($className)
    {
        $qaFile = PROJECT_PATH . DS . 'qa' . DS . str_replace('_', DS, $className) . '.php';
        if (file_exists($qaFile)) {
            require_once $qaFile;
        }
        $modelFile = PROJECT_PATH . DS . str_replace('_', DS, $className) . '.php';
        if (file_exists($modelFile)) {
            require_once $modelFile;
        }
    }
}
