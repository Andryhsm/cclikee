<?php

namespace App\Http\Controllers\admin;

use App\Interfaces\RegionRepositoryInterface;
use App\Models\Admin;
use App\Repositories\AdminRoleRepository;
use App\Repositories\AdminUserRepository;
use App\Repositories\UserRepository;
use App\Service\UploadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Session;
use Redirect;

class UserController extends Controller
{
    protected $admin_user_repository;
    protected $upload_service;
    protected $user_repository;
	protected $region_repository;

    public function __construct(AdminUserRepository $admin_user_repository, UploadService $upload_service,
								UserRepository $user_repository,
								RegionRepositoryInterface $region_repo
								)
    {
        $this->admin_user_repository = $admin_user_repository;
        $this->user_repository = $user_repository;
        $this->upload_service = $upload_service;
		$this->region_repository = $region_repo;
    }

    public function index(Request $request)
    {
        $role_id = ($this->getType($request) == 'merchant') ? '2' : '1';
        $users = $this->user_repository->getByRole($role_id);
        return view('admin.user.list')->with('users', $users)->with('type', $this->getType($request));
    }

    public function store(Request $request)
    {
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000' // max 10000kb
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $type = $request->get('type');
            $image_name = "";
            if (Input::file('profile_image')) {
                $file = Input::file('profile_image');
                try {
                    $image_name = $this->upload_service->upload($file, 'upload/profile');
                } catch (\Exception $e) {
                    flash()->error($e->getMessage());
                    return Redirect::back();
                }
            }

            $user_id = $this->user_repository->create($request->all(), $image_name);

            if ($user_id) {
                return Redirect::to('admin/' . $type);
            }
        }

    }

    public function getType($request)
    {
        return ($request->is('admin/merchant*')) ? 'merchant' : 'customer';
    }

    public function create(Request $request)
    {
		$countries = $this->region_repository->getCountries();
        return view('admin.user.form')->with('type', $this->getType($request))
			->with('countries',$countries);
    }

    public function show()
    {
        $user = Admin::get()->first();
        return view('admin.user.profile', compact('user'));
    }

    public function update($user_id, Request $request)
    {
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000' // max 10000kb
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $type = $request->get('type');
            $image_name = "";
            if (Input::file('profile_image')) {
                $file = Input::file('profile_image');
                try {
                    $image_name = $this->upload_service->upload($file, 'upload/profile');
                } catch (\Exception $e) {
                    flash()->error($e->getMessage());
                    return Redirect::back();
                }
            }
            if ($type) {
                $user = $this->user_repository->update($user_id, $request->all(), $image_name);
                return Redirect::to('admin/' . $type);
            } else {
                $admin_user = $this->admin_user_repository->update($user_id, $request->all(), $image_name);
                return Redirect::back();
            }
        }
    }

    public function edit($id, Request $request)
    {
        $user = $this->user_repository->getById($id);
		$countries = $this->region_repository->getCountries();
		return view('admin.user.edit')->with('users', $user)
			->with('type', $this->getType($request))
			->with('countries',$countries);
    }

    public function destroy($id, Request $request)
    {

        if ($this->user_repository->delete($id)) {
            flash()->success(config('message.role.delete-success'));
            return Redirect('admin/' . $this->getType($request));
        }

    }
}
