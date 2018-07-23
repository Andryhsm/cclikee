<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AttributeRequest;
use App\Interfaces\AttributeRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;

class AttributeController extends Controller
{
	protected $attribute_repository;

	public function __construct(AttributeRepositoryInterface $attribute_repo)
	{
		$this->attribute_repository = $attribute_repo;
	}

	public function index()
	{
		$attributes = Datatables::collection($this->attribute_repository->getAll())->make(true);
		$attributes = $attributes->getData();
		
		return view('admin.attribute.list', compact('attributes'));
		
	}

	public function create()
	{
		$attribute=false;
		return view('admin.attribute.form',compact('attribute'));
	}

	public function store(AttributeRequest $attribute_request)
	{
		$attributes = $this->attribute_repository->save($attribute_request->all());
		flash()->success(config('message.attribute.add-success'));
		return redirect()->route('attribute');
	}

	public function edit($attribute_id)
	{
		$attribute = $this->attribute_repository->getById($attribute_id);
		return view('admin.attribute.form',compact('attribute'));
	}

	//update
	public function update($attribute_id, AttributeRequest $attribute_request)
	{
		$attribute = $this->attribute_repository->updateById($attribute_id,$attribute_request->all());
		flash()->success(config('message.attribute.update-success'));
		return redirect()->route('attribute'); 
	}

	public function destroy($attribute_id)
	{
		if ($this->attribute_repository->deleteById($attribute_id)) {
			flash()->success(config('message.attribute.delete-success'));
		} else {
			flash()->error(config('message.attribute.delete-error'));
		}
		return redirect()->route('attribute');

	}

}
