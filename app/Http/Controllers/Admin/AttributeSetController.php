<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AttributeSet;
use App\Http\Requests\Admin\AttributeSetRequest;
use App\Interfaces\AttributeRepositoryInterface;
use App\Interfaces\AttributeSetRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class AttributeSetController extends Controller
{
	protected $attribute_set_repository;
	protected $attribute_repository;

	public function __construct(AttributeSetRepositoryInterface $attribute_set_repo, AttributeRepositoryInterface $attribute_repo)
	{
		$this->attribute_set_repository = $attribute_set_repo;
		$this->attribute_repository = $attribute_repo;

	}

	public function index()
	{
		$attribute_sets = Datatables::collection($this->attribute_set_repository->getAll())->make(true);
		$attribute_sets = $attribute_sets->getData();
		/*dd($attribute_sets);*/
		return view('admin.attribute_set.list', compact('attribute_sets'));
	}

	public function create()
	{
		$attribute_set = false;
		$all_attributes = $this->attribute_repository->getAll();
		$attributes = [];
		foreach ($all_attributes as $attribute) {
			$attributes[$attribute->attribute_id] = $attribute->french->attribute_name;
		}
		return view('admin.attribute_set.form', compact('attribute_set', 'attributes'));
	}

	public function store(AttributeSetRequest $attribute_set_request)
	{
		$attribute_set = $this->attribute_set_repository->save($attribute_set_request->all());
		flash()->success(config('message.attribute-set.add-success'));
		return redirect()->route('attribute_set');
	}

	public function edit($attribute_set_id)
	{
		$attribute_set = $this->attribute_set_repository->getById($attribute_set_id);
		$all_attributes = $this->attribute_repository->getAll();
		$attributes = [];
		foreach ($all_attributes as $attribute) {
			$attributes[$attribute->attribute_id] = $attribute->french->attribute_name;
		}
		return view('admin.attribute_set.form', compact('attribute_set', 'attributes'));
	}

	public function update($attribute_set_id, AttributeSetRequest $attribute_set_request)
	{
		$attribute = $this->attribute_set_repository->updateById($attribute_set_id, $attribute_set_request->all());
		flash()->success(config('message.attribute-set.update-success'));
		return redirect()->route('attribute_set');
	}

	public function destroy($attribute_set_id)
	{
		if ($this->attribute_set_repository->deleteById($attribute_set_id)) {
			flash()->success(config('message.attribute-set.delete-success'));
		} else {
			flash()->error(config('message.attribute-set.delete-error'));
		}
		return redirect()->route('attribute_set');
	}
}
