<?php 
namespace PHPMVC\Models;

class UserModel extends AbstractModel
{

    public $UserId;
    public $UserName;
    public $Password;
    public $Email;
    public $PhoneNumber;
    public $SubscriptionDate;
    public $LastLogin;
    public $GroupId;
    public $Status;

    protected static $tableName = 'app_users';
   
    protected static $tableSchema = array (
    'UserId'            => self::DATA_TYPE_INT,
    'UserName'          => self::DATA_TYPE_STR,
    'Password'          => self::DATA_TYPE_STR,
    'Email'             => self::DATA_TYPE_STR,
    'PhoneNumber'       => self::DATA_TYPE_STR,
    'SubscriptionDate'  => self::DATA_TYPE_STR,
    'LastLogin'         => self::DATA_TYPE_STR,
    'GroupId'           => self::DATA_TYPE_INT,
    'Status'            => self::DATA_TYPE_INT

    );
    protected static $primaryKey = 'UserId';

    public function cryptPassword($password){
        $salt = '$2a$07$8hb5re5ML0AkNTwDb2y8hb';
        $this->Password = crypt($password , $salt);
    }

    //public function __construct(){}

   // public function __get($prop){}

    public function getTableName(){
        return self::$tableName;
    }

    public static function getAll()
    {
        return self::get(
            'SELECT au.* , aug.GroupName GroupName FROM ' .self::$tableName.' au INNER JOIN app_users_groups aug ON au.GroupId = aug.GroupId'
        );
    }

    public static function userExists($username){
        return self::get (
            'SELECT * FROM ' .self::$tableName .' WHERE Username = "'. $username.'"'  
        );
    }

}