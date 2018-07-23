<?php
namespace App\Repositories;

use App\Interfaces\AdminUserRepositoryInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

/**
 * Class AdminUserRepository
 *
 * @package App\Repositories\Backend
 */
class AdminUserRepository implements AdminUserRepositoryInterface
{
	protected $model;
    /**
     * @param \App\Models\Admin $admin
     */
    function __construct(Admin $admin)
    {
        $this->model = $admin;
    }

    public function update($id, $input, $image_name)
    {
        $admin_user = $this->model->findOrNew($id);
        $admin_user->first_name=$input['first_name'];
        $admin_user->last_name=$input['last_name'];
        $admin_user->email=$input['email'];
        $admin_user->is_active=isset($input['is_active']) ? $input['is_active'] : '0';
        $admin_user->password = (!empty($input['password']))?Hash::make($input['password']) :$admin_user->password;
        if (!empty($image_name)) {
            $admin_user->profile_image = $image_name;
        }
        return $admin_user->save();
    }

	public function get()
	{
		return $this->model->orderBy('admin_id', 'desc')->get();
	}

	public function getById($admin_id)
	{
		return $this->model->where('admin_id', $admin_id)->first();
	}

	public function getByRole()
	{
		return $this->model->where('role_id', 2)->orWhere('role_id',4)->get();
	}

	public function save($input)
	{
		$this->model->first_name = $input['first_name'];
		$this->model->last_name = $input['last_name'];
		$this->model->email = $input['email'];
		$this->model->password = Hash::make($input['password']);
		$this->model->is_active = isset($input['is_active']) ? $input['is_active'] : '0';
		$this->model->role_id = $input['role_id'];
		$this->model->profile_image = $input['image_name'];
		$this->model->created_by = auth()->guard('admin')->user()->admin_id;
		$this->model->save();
		return $this->model;

	}

	public function updateById($admin_id, $input)
	{

		$admin = $this->model->findOrNew($admin_id);
		$admin->first_name = $input['first_name'];
		$admin->last_name = $input['last_name'];
		$admin->email = $input['email'];
		$admin->role_id = $input['role_id'];
		$admin->password = (!empty($input['password'])) ? Hash::make($input['password']) : $admin->password;
		$admin->is_active = isset($input['is_active']) ? $input['is_active'] : '0';
		$admin->profile_image = (isset($input['image_name']) && !empty($input['image_name'])) ? $input['image_name'] : $admin->profile_image;
		$admin->save();
		return $admin;

	}

	public function deleteById($admin_id)
	{
		return $this->model->where('admin_id', $admin_id)->delete();
	}
}