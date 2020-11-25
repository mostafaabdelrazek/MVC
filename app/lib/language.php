<?php
namespace PHPMVC\LIB;
 
class Language
{
    private $_dictionary = [];

    public function load($path)
    {

        $defaultLanguage = APP_DEFAULT_LANGUAGE;
        if(isset($_SESSION['lang'])){
            $defaultLanguage = $_SESSION['lang'];
        }
        $pathArray = explode('.' , $path);
        $languageFileToLoad =  (LANGUAGES_PATH . $defaultLanguage . DS . $pathArray[0] . DS . $pathArray[1] . '.lang.php');
        $lanuageFileContent = file_get_contents($languageFileToLoad);
        if(file_exists($languageFileToLoad)){
            require $languageFileToLoad;
            if(is_array($_) && !empty($_)){
                foreach ($_ as $key => $value) {
                    $this->_dictionary[$key] =  $value;
                }
            } else {
                triger_error('sorry the language file' . $path . 'doesnt\'t exist' , E_USER_WARNNG);
            }
        }
    }

    public function get($key){
        if(array_key_exists($key , $this->_dictionary)){
            return $this->_dictionary[$key];
        }
    }

      public function feedKey($key , $data){
        if(array_key_exists($key , $this->_dictionary)){
            array_unshift($data , $this->_dictionary[$key]);
            //var_dump($key);
            return call_user_func_array( 'sprintf' , $data);
        }
      }

    public function getDictionary(){
        return $this->_dictionary;
    }
}