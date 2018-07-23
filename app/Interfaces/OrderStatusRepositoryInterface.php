<?php

namespace App\Interfaces;


interface OrderStatusRepositoryInterface
{
	public function getAll();

	public function getById($status_id);

	public function save($input);

	public function updateById($status_id, $input);

	public function deleteById($status_id);


}