<?php
 
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\PrivilegeModel;
use PHPMVC\Models\UserGroupPrivilegeModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;

 class UsersGroupsController extends AbstractController
 {
     use InputFilter;
     use Helper;

    public function defaultAction()
    {
        $this->language->load('usersgroups.default');
        $this->_data['groups'] = UserGroupModel::getAll();
        $this->_view();
    }
      //TODO: WE NEED TO IMPLEMENT CSRF PREVENTION
      public function createAction()
      {
        $this->language->load('usersgroups.labels');
        $this->language->load('usersgroups.create');
        $this->_data['privileges'] = PrivilegeModel::getAll();
        if(isset($_POST['submit'])){
            $group = new UserGroupModel();
            $group->GroupName = $this->filterString($_POST['GroupName']);
            if($group->save()){
                if(isset($_POST['Privileges']) && is_array($_POST['Privileges'])){
                    foreach ($_POST['Privileges'] as $privilegeId) {
                        $groupPrivilege = new UserGroupPrivilegeModel();
                        $groupPrivilege->GroupId = $group->GroupId;
                        $groupPrivilege->PrivilegeId = $privilegeId;
                        $groupPrivilege->save();
                    }
                }
                $this->redirect('/usersgroups');
            }
        }
        $this->_view();
      }
      public function editAction()
      {
         $id = $this->filterInt($this->_params[0]);
         $group = UserGroupModel::getByPK($id);
         if($group === false){
            $this->redirect('/usersgroups');
         }

        $this->language->load('usersgroups.labels');
        $this->language->load('usersgroups.edit');

        $this->_data['group'] = $group;
        $this->_data['privileges'] = PrivilegeModel::getAll();
        $extractedPrivilegesId = UserGroupPrivilegeModel::userGroupPrivilege($group);
        $this->_data['groupPrivileges'] = $extractedPrivilegesId;
        
        if(isset($_POST['submit'])){
            $group->GroupName = $this->filterString($_POST['GroupName']);


            if($group->save()){
                if(isset($_POST['Privileges']) && is_array($_POST['Privileges'])){
                    $privilegeIdsToBeDeleted = array_diff($extractedPrivilegesId , $_POST['Privileges']); //Output = unchecked items.
                    $privilegeIdsToBeAdded = array_diff( $_POST['Privileges'] , $extractedPrivilegesId ); 

                    foreach ($privilegeIdsToBeDeleted as $deletedPrivilege) {
                        $unWantedPrivilege =  UserGroupPrivilegeModel::getBy(['PrivilegeId' => $deletedPrivilege ,'GroupId' => $group->GroupId]);
                        $unWantedPrivilege->current()->delete();
                    }
                    foreach ($privilegeIdsToBeAdded as $privilegeId) {
                        $groupPrivilege = new UserGroupPrivilegeModel();
                        $groupPrivilege->GroupId = $group->GroupId;
                        $groupPrivilege->PrivilegeId = $privilegeId;
                        $groupPrivilege->save();
                    }
                }
                $this->redirect('/usersgroups');
            }
        }
        $this->_view();
    }
    public function deleteAction()
    {
       $id = $this->filterInt($this->_params[0]);
       $group = UserGroupModel::getByPK($id);

       if($group === false){
          $this->redirect('/usersgroups');
       }

       $groupprivileges = UserGroupPrivilegeModel::getBy(['groupId' => $group->GroupId]);
       
       if(false !== $groupprivileges){
           foreach ($groupprivileges as $groupPrivilege) {
                $groupPrivilege->delete();
           }
       }
       if($group->delete()){
           $this->redirect('/usersgroups');
       }
      $this->_view();
  }
 }