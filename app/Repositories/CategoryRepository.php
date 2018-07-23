<?php

namespace App\Repositories;


use App\Category;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\CategoryTranslation;
use App\Url;

class CategoryRepository implements CategoryRepositoryInterface
{
	protected $model;

	public function __construct(Category $category)
	{
		$this->model = $category;
	}

	public function getTreeData()
	{
		$parent_category = $this->model->with(['english', 'french','url'])->where('parent_id', null)->orderBY('sort_order')->get();
		$category_parent_id = [];
		foreach ($parent_category as $category) {
			$category_parent_id[] = $category->category_id;										//listes des categories parents
		}
		$categories = $this->addRelation($parent_category);
		$categories_array = [];
		foreach ($categories as $index => $category) {
			$parent_ids = [];
			$categories_array[$index]['title'] = $category->french->category_name;
			$categories_array[$index]['english_title'] = $category->french->category_name;
			$categories_array[$index]['french_title'] = (!empty($category->french->category_name)) ? $category->french->category_name :$category->english->category_name;
			$categories_array[$index]['key'] = $category->category_id;
			//$categories_array[$index]['target_url'] = $category->url->target_url;
			$categories_array[$index]['children'] = $this->generateArray($category, $categories_array, []);			

		}
		return ['categories' => $categories, 'tree_data' => $categories_array, 'category_parent_id' => $category_parent_id];
	}

	protected function selectChild($parent_id)
	{
		$categories = Category::where('parent_id', $parent_id)->orderBY('sort_order')->get();
		$categories = $this->addRelation($categories);

		return $categories;

	}
	
	public function getChildCategory($parent_id)
	{
		$categories = Category::where('parent_id', $parent_id)->orderBY('sort_order')->get();
		$categories = $this->addRelation($categories);

		return $categories;
	}

	public function getParentCategories($language_id)
	{
	    return Category::with('translation','url','children')->where('parent_id',null)->active()->orderBY('sort_order')->get();
	}

	protected function addRelation($categories)
	{
		$categories->map(function ($item, $key) {
			$sub = $this->selectChild($item->category_id);
			return $item = array_add($item, 'subCategory', $sub);
		});
		return $categories;
	}

	protected function generateArray($category, $categories_array, $parent_ids)
	{
		$categories_array = [];
		if (count($category->subCategory) > 0) {
			foreach ($category->subCategory as $index => $sub_cat) {
				$categories_array[$index]['title'] = $sub_cat->french->category_name;
				$categories_array[$index]['english_title'] = $sub_cat->french->category_name;
				$categories_array[$index]['french_title'] = (!empty($sub_cat->french->category_name)) ? $sub_cat->french->category_name :$sub_cat->english->category_name;
				$categories_array[$index]['key'] = $sub_cat->category_id;
				//$categories_array[$index]['target_url'] = $sub_cat->url->target_url;
				$parent_ids[] = $sub_cat->parent->category_id;
				$parent_ids = array_unique($parent_ids);
				$categories_array[$index]['parent_ids'] = implode(',',  $parent_ids);
				$categories_array[$index]['children'] = $this->generateArray($sub_cat, $categories_array, $parent_ids);
			}
		}
		return $categories_array;
	}

	public function getById($category_id)
	{
		return $this->model->with('english','french', 'url')->where('category_id', $category_id)->first();
	}

	public function save($input)
	{
		$this->model->parent_id = ($input['parent_id'] != '') ? $input['parent_id'] : null;
		$this->model->is_active = isset($input['is_active']) ? $input['is_active'] : 0;
		$this->model->created_by = auth()->guard('admin')->user()->admin_id;
		$this->model->save();

		/*if(!empty($input['en_category_name']) || !empty($input['en_description'])){*/
			$category_translation = new CategoryTranslation();
			$category_translation->category_name = '';
			$category_translation->description = '';
			$category_translation->language_id = '1';
			$this->model->translation()->save($category_translation);
		/*}*/

		if(!empty($input['fr_category_name']) || !empty($input['fr_description'])){
			$category_translation = new CategoryTranslation();
			$category_translation->category_name = $input['fr_category_name'];
			$category_translation->description = $input['fr_description'];
			$category_translation->language_id = '2';
			$this->model->translation()->save($category_translation);
		}

		/*$url = new Url();
		$url->request_url = $input['category_url'];
		$url->target_url = $input['category_url'];
		$url->type = '1';
		$url->target_id = $this->model->category_id;
		$url->save();*/

		return $this->model;

	}

	public function updateById($category_id, $input)
	{
		$category = $this->model->findOrNew($category_id);
		$category->parent_id = ($input['parent_id'] != '') ? $input['parent_id'] : null;
		$category->is_active = isset($input['is_active']) ? $input['is_active'] : 0;
		$category->created_by = auth()->guard('admin')->user()->admin_id;
		$category->save();

        //$this is a test	
		if(isset($input['fr_category_name']) || !empty($input['fr_description'])){
			CategoryTranslation::updateOrCreate(['category_id'=>$category->category_id,'language_id'=>'2'],
				['category_name'=>$input['fr_category_name'],'description'=>$input['fr_description'],'language_id'=>'2']
			);
		}

		/*$url = Url::findOrNew(isset($input['url_id']) ? $input['url_id'] : 0);
		$url->request_url = $input['category_url'];
		$url->target_url = $input['category_url'];
		$url->type = '1';
		$url->target_id = $category->category_id;
		$url->save();*/

		return $category;

	}

	public function deleteById($category_id)
	{
		$category = $this->model->find($category_id);
		$category->url()->delete();
		return $category->delete();
	}
}