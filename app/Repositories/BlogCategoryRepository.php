<?php

namespace App\Repositories;


use App\Interfaces\BlogCategoryInterface;
use App\Models\BlogCategory;

class BlogCategoryRepository implements BlogCategoryInterface
{
	protected $model;

	public function __construct(BlogCategory $blog_category)
	{
		$this->model = $blog_category;
	}

	public function getAll()
	{
		return $this->model->with('admin')->orderBy('blog_category_id')->get();
	}

	public function save($input)
	{
		try {
			$this->model->english_name = $input['english_name'];
			$this->model->french_name = $input['french_name'];
			$this->model->is_active = (isset($input['is_active'])) ? $input['is_active'] : '0';
			$this->model->is_home_page = isset($input['is_home_page']) ? $input['is_home_page'] : '0';
			$this->model->created_by = auth()->guard('admin')->user()->admin_id;
			$this->model->save();
			return $this->model;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function updateById($blog_category_id, $input)
	{
		try {
			$blog_category = $this->model->findOrNew($blog_category_id);
			$blog_category->english_name = $input['english_name'];
			$blog_category->french_name = $input['french_name'];
			$blog_category->is_active = isset($input['is_active']) ? $input['is_active'] : '0';
			$blog_category->is_home_page = isset($input['is_home_page']) ? $input['is_home_page'] : '0';
			$blog_category->save();
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function deleteById($blog_category_id)
	{
		return $this->model->destroy($blog_category_id);
	}

	public function getById($blog_category_id)
	{
		return $this->model->with('admin')->where('blog_category_id', $blog_category_id)->first();
	}

	public function getAllActive()
	{
		return $this->model->where('is_active','1')->get();
	}
}