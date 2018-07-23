<?php

namespace App\Repositories;


use App\Interfaces\EpartnerRepositoryInterface;
use App\Models\EpartnerMedia;

class EpartnerRepository implements EpartnerRepositoryInterface
{

	protected $model;
	public function __construct(EpartnerMedia $epartnerMedia)
	{
		$this->model = $epartnerMedia;
	}

	public function save($input)
	{
		$this->model->name = $input['name'];
		$this->model->image = $input['image_name'];
		return $this->model->save();
	}

	public function getById($id)
	{
		return $this->model->find($id);
	}

	public function getAll()
	{
		return $this->model->get();
	}

	public function updateById($id, $input)
	{
		$this->model = $this->model->findOrNew($id);
		$this->model->name = $input['name'];
		$this->model->image = !empty($input['image_name']) ? $input['image_name'] : $this->model->image;
		return $this->model->save();
	}

	public function deleteById($id)
	{
		return $this->model->destroy($id);
	}

	public function getByName($name)
	{
		return $this->model->where('name','like',"%$name%")->first();
	}
}