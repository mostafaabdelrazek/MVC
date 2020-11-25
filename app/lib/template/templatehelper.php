<?php
namespace PHPMVC\Lib\Template;

trait TemplateHelper
{
    public function matchUrl($url)
    {
        return parse_url($_SERVER['REQUEST_URI'] , PHP_URL_PATH) == $url;
    }

    public function labelFloat($filedName){
        return isset($_POST[$filedName]) && !empty($_POST[$filedName]) ? 'class = "floated" ' : ''  ;
    }

    public function  showValue($filedName , $object = null){
        return isset($_POST[$filedName]) ? $_POST[$filedName] : (is_null($object) ? '' : $object->$filedName) ;
    }
}