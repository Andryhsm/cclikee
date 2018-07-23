<?php

namespace App\Interfaces;


interface BlogTagInterface
{
	public function getByKeyword($keyword);

	public function save($input);

	public function getAll();

}