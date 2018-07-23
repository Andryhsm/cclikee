<?php

namespace App\Interfaces;


interface AttributeSetRepositoryInterface
{
	public function getAll();

	public function save($input);

	public function getById($attribute_set_id);

	public function deleteById($attribute_set_id);

	public function updateById($attribute_set_id, $input);

}