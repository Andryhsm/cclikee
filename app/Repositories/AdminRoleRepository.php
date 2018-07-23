<?php

namespace App\Repositories;

use App\Interfaces\AdminRoleRepositoryInterface;
use App\Models\AdminRole;
use App\Models\PermissionRole;
use App\Models\Role;


class AdminRoleRepository implements AdminRoleRepositoryInterface
{
    protected $model;

    public function __construct(AdminRole $role)
    {
        $this->model = $role;
    }

    public function create($input)
    {

        $this->model->fill($input);
        $this->model->save();
        if (!empty($input['permission_id'])) {
            $permissions = explode(',', $input['permission_id']);
            foreach ($permissions as $permission) {
                $permission_role = New PermissionRole();
                $permission_role->permission_id = $permission;
                $permission_role->role_id = $this->model->admin_role_id;
                $permission_role->save();
            }
        }
        return $this->model;
    }

    public function update($id, $input)
    {

        $permission = $this->model->find($id);
        $permission->fill($input);
        $permission->save();


       $this->deletePermissionById($id);
        if (!empty($input['permission_id'])) {
            $permissions=explode(',',$input['permission_id']);
            foreach ($permissions as $permission_id) {
                $permission_role = New PermissionRole();
                $permission_role->permission_id = $permission_id;
                $permission_role->role_id = $id;
                $permission_role->save();
            }
        }

    }

    public function deletePermissionById($id){
        return PermissionRole::where('role_id',$id)->delete();
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function getAll()
    {
        return $this->model->all();
    }

}