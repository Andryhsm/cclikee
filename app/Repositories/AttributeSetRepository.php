<?php

namespace App\Repositories;


use App\AttributeSet;
use App\Interfaces\AttributeSetRepositoryInterface;

class AttributeSetRepository implements AttributeSetRepositoryInterface
{
	protected $model;

	public function __construct(AttributeSet $attribute_set)
	{
		$this->model = $attribute_set;
	}

	public function getAll()
	{
		return $this->model->with('admin','attributes','attributes.english','attributes.french')->orderBy('attribute_set_id', 'desc')->get();
	}

	public function save($input)
	{
		$this->model->set_name = $input['attribute_set_name'];
		$this->model->created_by = auth()->guard('admin')->user()->admin_id;
		$this->model->save();
		if (isset($input['attributes'])) {
			foreach ($input['attributes'] as $attribute) {
				$this->model->attributes()->attach($attribute);
			}
		}
	}

	public function getById($attribute_set_id)
	{
		return $this->model->with('attributes')->where('attribute_set_id', $attribute_set_id)->first();
	}

	public function deleteById($attribute_set_id)
	{
		return $this->model->where('attribute_set_id', $attribute_set_id)
			->delete();
	}

	public function updateById($attribute_set_id, $input)
	{
		$attribute_set = $this->model->findOrNew($attribute_set_id);
		$attribute_set->set_name = $input['attribute_set_name'];
		$attribute_set->save();
		$attribute_set->attributes()->detach();
		if (isset($input['attributes'])) {
			foreach ($input['attributes'] as $attribute) {
				$attribute_set->attributes()->attach($attribute);
			}
		}
		return $attribute_set;
	}

}