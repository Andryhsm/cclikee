<?php

namespace App\Interfaces;


interface EpartnerRepositoryInterface
{

	public function save($input);

	public function getById($id);

	public function updateById($id, $input);

	public function deleteById($id);

	public function getAll();

	public function getByName($name);

}