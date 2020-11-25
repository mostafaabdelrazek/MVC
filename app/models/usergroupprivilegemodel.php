<?php
namespace PHPMVC\Models;

class UserGroupPrivilegeModel extends AbstractModel
{
    public $Id;
    public $GroupId;
    public $PrivilegeId;

    protected static $tableName = 'app_users_groups_privileges';
   
    protected static $tableSchema = array (
    'Id'                =>self::DATA_TYPE_INT,
    'GroupId'            => self::DATA_TYPE_INT,
    'PrivilegeId'          => self::DATA_TYPE_INT,
    );
    protected static $primaryKey = 'Id';

    //public function __construct(){}

   // public function __get($prop){}

    public function getTableName(){
        return self::$tableName;
    }

    public function userGroupPrivilege(UserGroupModel $group){
        $groupprivileges = self::getBy(['groupId' => $group->GroupId]);
        $extractedPrivilegesId = [];
        if(false !== $groupprivileges){
             foreach ($groupprivileges as $privilege) {
                 $extractedPrivilegesId[] = $privilege->PrivilegeId; 
             }
           }
           return $extractedPrivilegesId;
    }

}