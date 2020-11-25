<?php
 
namespace PHPMVC\Controllers;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\Models\PrivilegeModel;
use PHPMVC\Models\UserGroupPrivilegeModel;
use PHPMVC\LIB\Messenger;

 class PrivilegesController extends AbstractController
 {
     use InputFilter;
     use Helper;
    public function defaultAction()
    {
        $this->language->load('privileges.default');
        $this->_data['privileges'] = PrivilegeModel::getAll();
        $this->_view();
    }

    //TODO: WE NEED TO IMPLEMENT CSRF PREVENTION
    public function createAction()
    {
        $this->language->load('privileges.labels');
        $this->language->load('privileges.create');
        if(isset($_POST['submit'])){
            $privilege = new PrivilegeModel();
            $privilege->PrivilegeTitle  = $this->filterString($_POST['PrivilegeTitle']);
            $privilege->Privilege       = $this->filterString($_POST['Privilege']);
            if($privilege->save()){
                
                $this->messenger->add('add succefully');
                $this->redirect('/privileges');
            }
        }
        $this->_view();
    }

    public function editAction()
    {
        $privilegeId = $this->filterInt($this->_params[0]);
        $privilege = PrivilegeModel::getByPK($privilegeId);
        if($privilege === false){
            $this->redirect('/privileges');
        }
        
        $this->_data['privilege'] = $privilege;

        $this->language->load('privileges.labels');
        $this->language->load('privileges.edit');

        if(isset($_POST['submit'])){
            $privilege->PrivilegeTitle  = $this->filterString($_POST['PrivilegeTitle']);
            $privilege->Privilege       = $this->filterString($_POST['Privilege']);
            if($privilege->save()){
                $this->redirect('/privileges');
            }
        }
        $this->_view();
    }
    public function deleteAction()
    {
        $privilegeId = $this->filterInt($this->_params[0]);
        $privilege = PrivilegeModel::getByPK($privilegeId);
        
        if($privilege === false){
            $this->redirect('/privileges');
        };
        $groupprivileges = UserGroupPrivilegeModel::getBy(['PrivilegeId' => $privilege->PrivilegeId]);
       
        if(false !== $groupprivileges){
            foreach ($groupprivileges as $groupPrivilege) {
                 $groupPrivilege->delete();
            }
        }
        if($privilege->delete()){
            $this->redirect('/privileges');
        }
        $this->_view();
    }
 }