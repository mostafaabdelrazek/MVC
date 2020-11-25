<?php
 
namespace PHPMVC\Controllers;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\UserModel;
use PHPMVC\Models\UserGroupModel;


 class UsersController extends AbstractController
 {
     use InputFilter;
     use Helper;

     private $_createActionRules = [
         'Username'             =>  'req|alphanum|between(3,12)',
         'Password'             =>  'req|min(6)|eqField(CPassword)',
         'CPassword'            => 'req',
         'Email'                =>  'req|email|eqField(CEmail)',
         'CEmail'               =>  'req|email',
         'PhoneNumber'          =>  'alphanum|max(15)',
         'GroupId'              =>  'req|int'
     ];
     
    public function defaultAction()
    {
        $this->language->load('users.default');
        $this->_data['users'] = UserModel::getAll();
        $this->_view();
    }

    public function createAction(){
        
        $this->language->load('users.create');
        $this->language->load('users.labels');
        $this->language->load('users.messeges');
        $this->language->load('validation.errors');

        $this->_data['groups'] = UserGroupModel::getAll();
        
        if( isset($_POST['submit']) && $this->isValid($this->_createActionRules , $_POST) ){
            $user = new UserModel();
            $user->UserName = $this->filterString($_POST['Username']);
            $user->cryptPassword($_POST['Password']);
            $user->Email = $this->filterString($_POST['Email']);
            $user->PhoneNumber = $this->filterString($_POST['PhoneNumber']);
            $user->GroupId = $this->filterInt($_POST['GroupId']);
            $user->SubscriptionDate = date('Y-m-d');
            //echo $user->SubscriptionDate;
            $user->LastLogin = date( 'Y-m-d H:i:s');
            $user->Status = 1;
            if($user->save()){
                 $this->messenger->add($this->language->get('message_create_success'));
            } else {
                $this->messenger->add( $this->language->get('message_create_field') , Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/users');
        }

        $this->_view();
    }

    // TODO:: make sure this is a AJAX Request
    // TODO:: explain the different types of headers used in this course
    public function checkUserExistsAjaxAction()
    {
        if(isset($_POST['Username']) && !empty($_POST['Username'])) {
          //echo 'test';
            header('Content-type: text/plain');
            if(UserModel::userExists($this->filterString($_POST['Username'])) !== false) {
                echo 1;
            } else {
                echo 2;
            }
        }
    }
 }