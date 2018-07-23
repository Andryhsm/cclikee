<?php

namespace App\Interfaces;


interface StoreRepositoryInterface
{
	public function getAll();

	public function save($input);

	public function updateById($store_id, $input);

	public function getById($store_id);

	public function deleteById($store_id);

	public function getByUserId($user_id);

	public function getCount();

	public function getDashboardStore();

	public function add($input,$user_id=null);

	public function update($id,$input);
}