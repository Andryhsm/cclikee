<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\Admin\CategoryRequest;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\LanguageInterface;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
	protected $category_repository;
	protected $brand_repository;
	protected $language_repository;

	public function __construct(CategoryRepositoryInterface $category_repo, BrandRepositoryInterface $brand_repo, LanguageInterface $language)
	{
		$this->category_repository = $category_repo;
		$this->brand_repository = $brand_repo;
		$this->language_repository = $language;
	}

	public function index()
	{
		$categories = $this->category_repository->getTreeData();
		$languages = $this->language_repository->getOptions();
		return view('admin.category.list', compact('categories', 'languages'));
	}

	public function store(CategoryRequest $category_request)
	{
		$category = $this->category_repository->save($category_request->all());
		flash()->success(config('message.category.add-success'));
		return redirect()->route('category');
	}

	public function update($category_id, CategoryRequest $category_request)
	{
		$attribute = $this->category_repository->updateById($category_id, $category_request->all());
		flash()->success(config('message.category.update-success'));
		return redirect()->route('category');
	}

	public function edit($category_id, CategoryRequest $category_request)
	{
		$category = $this->category_repository->getById($category_id);
		return Response::json($category);
	}

	public function destroy($category_id)
	{
		if ($this->category_repository->deleteById($category_id)) {
			flash()->success(config('message.category.delete-success'));
		} else {
			flash()->error(config('message.category.delete-error'));
		}
		return redirect()->route('category');
	}

	public function updateOrder(Request $request)
	{
		$input = $request->all();
		$parent_id = ($input['parent_id']=='_1') ?null:$input['parent_id'];
		if(!empty($input['child_data'])){
			foreach ($input['child_data'] as $index=>$child_id)
			{
				Category::where('category_id',$child_id)
					->update(['parent_id'=>$parent_id,'sort_order'=>$index]);
			}
		}

	}

}
