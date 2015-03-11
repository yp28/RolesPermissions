<?php namespace RolesPermissions\Models;

/**
 * Class Role
 * @package RolesPermissions\Models
 *
 *
 * Database tables
 *
 * roles:
 * id - integer, auto_increment, primary_key
 * name - varchar(255)
 * UNIQUE: name
 *
 * roles_permissions:
 * id - integer, auto_increment, primary_key
 * role_id - integer
 * permission_id - integer
 * UNIQUE: (role_id, permission_id)
 *
 * roles_roleable:
 * id - integer, auto_increment, primary_key
 * role_id - integer
 * roleable_type - varchar(255)
 * roleable_id - integer
 */

class Role
{

    /**
     * Database table for Role
     * @var string
     */
    public static $table = 'roles';

    /**
     * Database table for ManyToMany to Permission
     * @var string
     */
    public static $tableToPermissions = 'roles_permissions';

    /**
     * @var string
     */
    public static $tableToRoleable = 'roles_roleable';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array|Permission
     */
    private $permissions;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return array|Permission
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param array|Permission $permissions
     */
    public function setPermissions(array $permissions)
    {
        foreach($permissions as $permission)
            if($permission instanceof Permission)
                $this->permissions[] = $permission;
    }

    /**
     * @param string $permission
     * @return boolean
     */
    public function hasPermission($permission)
    {
        foreach($this->permissions as $p)
            if($permission == $p->getName())
                return true;
        return false;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

}