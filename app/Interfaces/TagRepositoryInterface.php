<?php

namespace App\Interfaces;


interface TagRepositoryInterface
{
	public function getByKeyword($keyword);

	public function save($input);

	public function getAll();

	public function removeById($id);
}