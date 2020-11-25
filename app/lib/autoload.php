<?php 
 //classis form Controller (front controllers Pattern)
 // modern way will be request/route/dispatch/response

namespace PHPMVC\LIB;

class AutoLoad
{

    public static function autoload($className)
    {
        $className = strtolower($className);
        $className = str_replace('phpmvc' , '' , $className);
        //$className = str_replace('\\' , '/', $className); //for linux
        $className = $className . '.php';
        if(file_exists(APP_PATH . $className))
        {
            //echo APP_PATH . $className; //test
            require_once APP_PATH . $className;
        }
    }
}
spl_autoload_register(__NAMESPACE__ . DS.'AutoLoad::autoload');