<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use App\Interfaces\ProductRatingRepositoryInterface;
use App\Models\Permission;
use App\Models\ProductRating;
use Illuminate\Support\Facades\Hash;

class PermissionRepository implements PermissionRepositoryInterface
{
    protected $model;


    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    public function getTreeData(){
        $parent=$this->model->where('parent_id',null)->get();
        $permissions = $this->addRelation($parent);
        $permission_array=[];
        foreach ($permissions as $index => $permission) {

            $permission_array[$index]['title'] = $permission->module_name;
            $permission_array[$index]['key'] = $permission->permission_id;
            $permission_array[$index]['children'] = $this->generateArray($permission, $permission_array);
        }

        return ['categories' => $permissions, 'tree_data' => $permission_array];
    }
    protected function addRelation($categories)
    {
        $categories->map(function ($item, $key) {
            $sub = $this->selectChild($item->permission_id);
            return $item = array_add($item, 'subCategory', $sub);
        });
        return $categories;
    }

    protected function selectChild($parent_id)
    {
        $categories = Permission::where('parent_id', $parent_id)->get();
        $categories = $this->addRelation($categories);

        return $categories;

    }

    protected function generateArray($permission)
    {
        $permissions_array = [];
        if (count($permission->subCategory) > 0) {
            foreach ($permission->subCategory as $index => $sub_permission) {
                $permissions_array[$index]['title'] = $sub_permission->module_name;
                $permissions_array[$index]['key'] = $sub_permission->permission_id;
                $permissions_array[$index]['children'] = $this->generateArray($sub_permission, $permissions_array);
            }
        }
        return $permissions_array;
    }

}