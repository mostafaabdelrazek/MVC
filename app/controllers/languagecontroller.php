<?php
 namespace PHPMVC\Controllers;
 use PHPMVC\Lib\Helper;

class LanguageController extends abstractController
{
    use Helper;
    public function defaultAction()
    {
        if($_SESSION['lang'] == APP_DEFAULT_LANGUAGE){
            $_SESSION['lang'] = 'en';
        }else{
            $_SESSION['lang'] = APP_DEFAULT_LANGUAGE;
        }
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}