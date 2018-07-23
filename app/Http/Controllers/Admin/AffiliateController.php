<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\LinkAdjustment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use App\Repositories\LinkAdjustmentRepository;
use App\Repositories\UserRepository;

class AffiliateController extends Controller
{
    protected $link_adjustment_repository;
    protected $user_repository;
    const CUSTOMER_ROLE_ID=1;

    public function __construct(LinkAdjustmentRepository $link_adjustment, UserRepository $user)
    {
        $this->link_adjustment_repository = $link_adjustment;
        $this->user_repository = $user;
    }

	public function index()
	{
        $links=$this->link_adjustment_repository->getAll();
		return view('admin.affiliate.list',compact('links'));
	}

    public function training()
    {
        return view('admin.training.page');
    }

    public function show($id)
    {
        //
    }

	public function create()
	{
        $users = $this->user_repository->getByRole(self::CUSTOMER_ROLE_ID);
        return view('admin.affiliate.form', compact('users'));
	}

    public function store(Request $request)
    {
        $rules = array(
            'link' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            if ($this->link_adjustment_repository->create($request->all())) {
                flash()->success(config('message.link_adjustment.add-success'));
                return Redirect('admin/affiliate');
            } else {
                flash()->success(config('message.link_adjustment.add-error'));
                return Redirect::back();
            }

        }
    }

    public function edit($id)
    {
        //
        $link = $this->link_adjustment_repository->getById($id);
        $users = $this->user_repository->getByRole(self::CUSTOMER_ROLE_ID);
        return view('admin.affiliate.edit', compact('link','users'));
    }

    public function update(Request $request, $id)
    {

        $rules = array(
            'link' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            if ($this->link_adjustment_repository->updateById($id, $request->all())) {
                flash()->success(config('message.link_adjustment.update-success'));
                return Redirect('admin/affiliate');
            } else {
                flash()->success(config('message.link_adjustment.update-error'));
                return Redirect::back();
            }
        }
    }

    public function destroy($id)
    {
        if ($this->link_adjustment_repository->deleteById($id)) {
            flash()->success(config('message.link_adjustment.delete-success'));
        } else {
            flash()->error(config('message.link_adjustment.delete-error'));
        }
        return Redirect::to('admin/affiliate');

    }
}
