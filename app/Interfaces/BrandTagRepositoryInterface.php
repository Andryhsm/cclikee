<?php

namespace App\Interfaces;


interface BrandTagRepositoryInterface
{
	public function getByKeyword($keyword);

	public function save($input);

	public function deleteById($tag_id);

}