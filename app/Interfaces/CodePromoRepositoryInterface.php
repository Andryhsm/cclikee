<?php
namespace App\Interfaces;

interface CodePromoRepositoryInterface
{
	public function save($input);

	public function getAll($user_id);

	public function updateById($code_promo_id, $input);

	public function deleteById($code_promo_id);

	public function getById($code_promo_id);

	public function getByUserCategory($category_id, $user_id);
}