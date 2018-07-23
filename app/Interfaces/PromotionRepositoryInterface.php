<?php
namespace App\Interfaces;

interface PromotionRepositoryInterface
{
	public function save($input);

	public function getAll($user_id);

	public function updateById($promotion_id, $input);

	public function deleteById($promotion_id);

	public function getById($promotion_id);
}