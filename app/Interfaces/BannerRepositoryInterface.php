<?php
namespace App\Interfaces;

interface BannerRepositoryInterface
{
	public function create($input,$image_name);

	public function getAll();

	public function updateById($product_id, $input,$image_name);

	public function deleteById($product_id);

	public function getById($product_id);

	public function getActiveBanner();
	
	public function getActiveMainBanner();

	public function getActiveSubBanner();

	public function getActiveSlider();

	public function getAllBanner();

	public function getAllSlider();
}