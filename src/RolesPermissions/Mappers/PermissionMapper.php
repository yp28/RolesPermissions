<?php namespace RolesPermissions\Mappers;

use RolesPermissions\Models\Permission;
use RolesPermissions\Models\Role;
use Zend\Db\Sql\Sql;

class PermissionMapper extends MySQLMapper
{

    /**
     * @param string $name
     * @return Permission
     */
    public function findByName($name)
    {
        $sql = new Sql($this->dbAdapter);
        $select = $sql->select(Permission::$table)->where(array('name = ?', $name));

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if(($permissionRow = $result->current()))
        {
            $permission = new Permission();
            $permission->setId($permissionRow['id']);
            $permission->setSubject($permissionRow['subject']);
            $permission->setType($permission['type']);

            return $permission;
        }
        return null;
    }

    /**
     * @param Role $role
     * @return array|Permission
     */
    public function findByRole(Role $role)
    {
        $sql = new Sql($this->dbAdapter);
        $select = $sql->select(array('p' => Permission::$table))
            ->join(array('rp' => Role::$tableToPermissions), 'p.id = rp.permission_id', array())
            ->join(array('r' => Role::$table), 'rp.role_id = r.id', array())
            ->where(array('r.id = ?' => $role->getId()));

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        $return = array();
        foreach($result as $permissionRow)
        {
            $tmpPermission = new Permission();
            $tmpPermission->setId($permissionRow['id']);
            $tmpPermission->setSubject($permissionRow['subject']);
            $tmpPermission->setType($permissionRow['type']);

            $return[] = $tmpPermission;
        }

        return $return;
    }

}