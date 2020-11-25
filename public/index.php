<?php
namespace PHPMVC;
use PHPMVC\LIB\FrontController;
use PHPMVC\LIB\SessionManager;
use PHPMVC\LIB\Registry;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\Template\Template;
use PHPMVC\LIB\Language;

require_once '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'CONFIG.PHP';
require_once APP_PATH . DS . 'lib' . DS . 'autoload.php';


$session = new SessionManager();
$session->start();

if(!isset($session->lang)){
    $session->lang = APP_DEFAULT_LANGUAGE;
}

$template_parts = require_once '..' . DS . 'app' . DS . 'config' . DS .'tamplateconfig.php';

$template = new Template($template_parts);
$language = new Language();
$messenger = Messenger::getInstance($session);

$registry = Registry::getInstance();
$registry->session = $session;
$registry->language = $language;
$registry->messenger = $messenger;
//var_dump($language);
$fc = new FrontController($template , $registry);
$fc->dispatch();

//dependance injection //lose coupling  