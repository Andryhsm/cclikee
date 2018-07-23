<?php

namespace App\Repositories;


use App\Interfaces\BlogTagInterface;
use App\Models\BlogTag;

class BlogTagRepository implements BlogTagInterface
{
	protected $model;

	public function __construct(BlogTag $blog_tag)
	{
		$this->model = $blog_tag;
	}

	public function getByKeyword($keyword)
	{
		return $this->model->where('tag_name', 'like', "%$keyword%")->get();
	}

	public function save($input)
	{
		$this->model->tag_name = $input['tag'];
		$this->model->save();
		return $this->model;
	}

	public function getAll()
	{
		return $this->model->get();
	}

}