<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogCategoryRequest;
use App\Interfaces\BlogCategoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogCategoryController extends Controller
{
	protected $blog_category_repository;

	public function __construct(BlogCategoryInterface $blog_category_repo)
	{
		$this->blog_category_repository = $blog_category_repo;
	}

	public function index()
	{
		$blog_categories = \Datatables::collection($this->blog_category_repository->getAll())->make(true);
		$blog_categories = $blog_categories->getData();
		return view('admin.blog.blog-category-list', compact('blog_categories'));
	}

	public function create()
	{
		$category = false;
		return view('admin.blog.blog-category-form', compact('category'));
	}

	public function store(BlogCategoryRequest $blog_category_request)
	{
		$category = $this->blog_category_repository->save($blog_category_request->all());
		flash()->success(config('message.blog-category.add-success'));
		return redirect()->route('blog-category.index');
	}


	public function edit($id)
	{
		$category = $this->blog_category_repository->getById($id);
		return view('admin.blog.blog-category-form', compact('category'));
	}

	public function update(BlogCategoryRequest $blog_category_request, $id)
	{
		$category = $this->blog_category_repository->updateById($id, $blog_category_request->all());
		flash()->success(config('message.blog-category.update-success'));
		return redirect()->route('blog-category.index');
	}

	public function destroy($id)
	{
		$status = $this->blog_category_repository->deleteById($id);
		if ($status) {
			flash()->success(config('message.blog-category.delete-success'));
		} else {
			flash()->error(config('message.blog-category.delete-error'));
		}
		return redirect()->route('blog-category.index');
	}
}
