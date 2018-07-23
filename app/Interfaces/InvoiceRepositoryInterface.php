<?php

namespace App\Interfaces;


interface InvoiceRepositoryInterface
{

	public function save($input);

	public function getAll();

	public function getById($id);

	public function getAllByPaginate();
}