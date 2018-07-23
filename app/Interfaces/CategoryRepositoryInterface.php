<?php

namespace App\Interfaces;


interface CategoryRepositoryInterface
{
	public function getTreeData();

	public function getById($category_id);

	public function save($input);

	public function updateById($category_id, $input);

	public function deleteById($category_id);

	public function getParentCategories($language_id);
	
	public function getChildCategory($parent_id);
}