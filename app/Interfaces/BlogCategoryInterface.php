<?php

namespace App\Interfaces;


interface BlogCategoryInterface
{

	public function getAll();

	public function save($input);

	public function updateById($blog_category_id, $input);

	public function deleteById($blog_category_id);

	public function getById($blog_category_id);

	public function getAllActive();

}