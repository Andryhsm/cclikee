<?php
namespace App\Interfaces;

interface ProductRepositoryInterface
{
	public function save($input);

	public function getAll();

	public function updateById($product_id, $input);

	public function deleteById($product_id);

	public function getById($product_id);

	public function removeMediaByName($image_name);

	public function getAttributesBySetId($attribute_set_id);

	public function getAttributesByProductId($product_id);

	public function getByCategory($category,$q);

	public function getProductById($product_id);

	public function getByKeyword($keyword,$language_id);

	public function getAttributeByProducts($product_ids);

    public function getProductByName($name);

	public function getByBrandsId($brands_id);

	public function getCount();

	public function getDashboardProduct();

	public function updateBestPrice($product_id);

	public function getByCategories($categories);
}