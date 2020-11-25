<?php
 
namespace PHPMVC\Controllers;
use PHPMVC\LIB\Validate;
 class IndexController extends AbstractController
 {
   use validate;
    public function defaultAction()
    {
     $this->language->load('index.default');
      //$str = 'الحقل %s يجب ان يحتوي علي قيمة';
      //$newString = sprintf($str , 'اسم المستخدم');
      //echo $newString; 
     // echo  password_hash('encryptedkey', CRYPT_BLOWFISH);
    // echo date('Y-m-d');
      $this->_view();
    }

 }