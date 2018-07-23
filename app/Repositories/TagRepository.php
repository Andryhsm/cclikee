<?php

namespace App\Repositories;


use App\Interfaces\TagRepositoryInterface;
use App\Tag;

class TagRepository implements TagRepositoryInterface
{
	protected $model;

	public function __construct(Tag $tag)
	{
		$this->model = $tag;
	}

	public function getByKeyword($keyword)
	{
		return $this->model->where('tag', 'like', "%$keyword%")->get();
	}

	public function save($input)
	{
		$this->model->tag = $input['tag'];
		$this->model->created_by = auth()->guard('admin')->user()->admin_id;
		$this->model->save();
		return $this->model;
	}

	public function getAll()
	{
		return $this->model->get();
	}

	public function removeById($id)
	{
		return $this->model->destroy($id);
	}
}