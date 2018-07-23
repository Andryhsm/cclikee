<?php

namespace App\Interfaces;


interface AttributeRepositoryInterface
{
	public function getAll();

	public function save($input);

	public function getById($attribute_id);

	public function deleteById($attribute_id);

	public function updateById($attribute_id, $input);
}