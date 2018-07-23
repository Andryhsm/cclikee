<?php
/**
 * Created by PhpStorm.
 * User: Arsenaltech
 * Date: 6/24/2017
 * Time: 12:37 AM
 */

namespace App\Interfaces;


interface FaqRepositoryInterface
{
	public function getAll();

	public function getById($id);

	public function store($input);

	public function updateById($id, $input);

	public function deleteById($id);

	public function getByType($type);

}