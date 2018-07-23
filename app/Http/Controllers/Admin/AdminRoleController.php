<?php

namespace App\Http\Controllers\admin;

use App\Models\AdminRole;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Repositories\AdminRoleRepository;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminRoleController extends Controller
{

    protected $admin_role_repository;

    public function __construct(AdminRoleRepository $admin_role_repository,PermissionRepository $permission_repository)
    {
        $this->admin_role_repository = $admin_role_repository;
        $this->permission_repository = $permission_repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = AdminRole::all();
        return view('admin.role.list')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=$this->permission_repository->getTreeData();
        return view('admin.role.form',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = array(
            'role_name' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $admin_user = $this->admin_role_repository->create($request->all());
            flash()->success(config('message.role.add-success'));
            return Redirect::to('admin/role');
        }
        flash()->success(config('message.role.add-error'));
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories=$this->permission_repository->getTreeData();
        $role = AdminRole::find($id);
        $permissions_by_role=PermissionRole::where('role_id',$id)->get();
        return view('admin.role.edit',compact('categories','permissions_by_role'))->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'role_name' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $admin_user = $this->admin_role_repository->update($id, $request->all());
            flash()->success(config('message.role.update-success'));
            return Redirect('admin/role');
        }
        flash()->error(config('message.role.update-error'));
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->admin_role_repository->delete($id)) {
            flash()->success(config('message.role.delete-success'));
            return Redirect('admin/role');
        }
    }
}
