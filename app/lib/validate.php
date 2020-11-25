<?php
namespace PHPMVC\LIB;

trait Validate
{
    private $_regexPatternes = [

        'num'               => '/^[0-9]+(?:\.[0-9]+)?$/',
        'int'               => '/^[0-9]+$/',
        'float'             => '/^[0-9]+\.[0-9]+$/',
        'alpha'             => '/^[a-zA-Z\p{Arabic}]+$/u',
        'alphanum'          => '/^[a-zA-Z\p{Arabic}0-9]+$/u',
        'vdate'             => '/^[1-2][0-9][0-9][0-9]-(?:(?:0[1-9])|(?:1[0-2]))-(?:(?:0[1-9])|(?:(?:1|2)[0-9])|(?:3[0-1]))$/',
        'email'             => '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/',
        'url'               => '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
    ];

    public function req($value)
    {
        return '' != $value || !empty($value);
    }

    public function num($value)
    {
        return (bool)preg_match($this->_regexPatternes['num'], $value);
    }

    public function int($value)
    {
        return (bool)preg_match($this->_regexPatternes['int'], $value);
    }
    
    public function float($value)
    {
        return (bool)preg_match($this->_regexPatternes['float'], $value);
    }
    
    public function alpha($value)
    {
        return (bool)preg_match($this->_regexPatternes['alpha'], $value);
    }

    public function alphanum($value)
    {
        return (bool)preg_match($this->_regexPatternes['alphanum'], $value);
    }

    public function eq($value , $matchAgainest)
    {
        return $value === $matchAgainest;
    }

    public function eqField($value , $otherFieldValue)
    {
        return $value === $otherFieldValue;
    }

    public function lt($value, $matchAgainest)
    {
        if(is_numeric($value)){
            return $value < $matchAgainest;
        }elseif(is_string($value)){
            return mb_strlen($value) < $matchAgainest;
        }
    }

    public function gt($value, $matchAgainest)
    {
        if (is_numeric($value)){
            return $value > $matchAgainest;
        } elseif (is_string($value)){
            return mb_strlen($value) > $matchAgainest;
        }
    }
    
    public function min($value, $min)
    {
        if(is_string($value)){
            return mb_strlen($value) >= $min;
        }elseif(is_numeric($value)){
            return $value >= $min;
        }
    }

    public function max($value, $max)
    {
        if(is_string($value)){
            return mb_strlen($value) <= $max;
        }elseif(is_numeric($value)){
            return $value <= $max;
        }
    }

    public function between($value, $min, $max)
    {
        if(is_numeric($value)){
            return $value <= $max && $value >= $min;
        }elseif(is_string($value)){
            return mb_strlen($value) <= $max &&  mb_strlen($value) >= $min;
        }
    }
    
    public function floatLike($value , $beforeDP , $afterDP){
        if(!$this->float($value)){
            return false;
        }
        $pattern = '/^[0-9]{'.$beforeDP.'}\.[0-9]{'.$afterDP.'}$/';
        return (bool)preg_match($pattern , $value);
    }

    public function vdate($value){
        return (bool)preg_match($this->_regexPatternes['vdate'] , $value);
    } 

    public function email($value){
        return (bool)preg_match($this->_regexPatternes['email'] , $value);
    } 

    
    public function url($value){
        return (bool)preg_match($this->_regexPatternes['url'] , $value);
    } 

    public function isValid($roles , $inputType){
         $errors = [];
         if(!empty($roles)){
            foreach ($roles as $fieldName => $validationRoles) {
                $value = $inputType[$fieldName];
                $validationRoles = explode('|' , $validationRoles);
                foreach ($validationRoles as $validationRole) {
                    if(array_key_exists($fieldName , $errors))
                        continue;
                    if(preg_match('/(min)\((\d+)\)/',$validationRole, $matches) 
                    || preg_match('/(max)\((\d+)\)/',$validationRole, $matches) 
                    || preg_match('/(lt)\((\d+)\)/',$validationRole, $matches) 
                    || preg_match('/(gt)\((\d+)\)/',$validationRole, $matches)
                    || preg_match('/(eq)\((\w+)\)/',$validationRole, $matches)){
                        $fun = $matches[1];
                        
                        if($this->$fun($value , $matches[2]) === false){
                            $this->messenger->add( 
                                $this->language->feedKey( 'text_error_' . $matches[1] , [$this->language->get('text_label_' . $fieldName) , $matches[2]]),
                                Messenger::APP_MESSAGE_ERROR);
                                $errors[$fieldName] = true;
                        }
                    }elseif(preg_match('/(eqField)\((\w+)\)/',$validationRole, $matches)){
                        $fun = $matches[1];
                        $otherField = $inputType[$matches[2]];
                        if($this->$fun($value , $otherField) === false){
                            $this->messenger->add( 
                                $this->language->feedKey( 'text_error_' . $matches[1] , [$this->language->get('text_label_' . $fieldName) , $this->language->get('text_label_' .  $matches[2])]),
                                Messenger::APP_MESSAGE_ERROR);
                                $errors[$fieldName] = true;
                            }
                    }elseif( preg_match('/(between)\((\d+),(\d+)\)/',$validationRole, $matches) 
                    || preg_match('/(floatLike)\((\d+),(\d+)\)/',$validationRole, $matches) )
                    {
                        $fun = $matches[1];
                        if($this->$fun($value , $matches[2] , $matches[3] ) === false){
                            $this->messenger->add( 
                                $this->language->feedKey( 'text_error_' . $matches[1] , [$this->language->get('text_label_' . $fieldName) , $matches[2] , $matches[3]]),
                                 Messenger::APP_MESSAGE_ERROR);
                                $errors[$fieldName] = true;
                        }
                    }else {
                        if($this->$validationRole($value) === false){
                            $this->messenger->add( 
                                $this->language->feedKey( 'text_error_' . $validationRole , [$this->language->get('text_label_' . $fieldName)]),
                                Messenger::APP_MESSAGE_ERROR);
                                $errors[$fieldName] = true;
                        }
                    }
                }
            }
         }
         return empty($errors) ? true : false;
    }
}