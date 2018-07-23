<?php

namespace App\Repositories;

use App\Interfaces\ProductStatusRepositoryInterface;
use App\ProductStatus;

class ProductStatusRepository implements ProductStatusRepositoryInterface
{
	protected $model;

	public function __construct(ProductStatus $productStatus)
	{
		$this->model = $productStatus;
	}

	public function getAll()
	{
		return $this->model->get();
	}
}