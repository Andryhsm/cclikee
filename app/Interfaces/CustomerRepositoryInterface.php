<?php
namespace App\Interfaces;

interface CustomerRepositoryInterface
{
	public function create($input);

	public function getCustomerSystemById($id);

	public function update($id,$input);

	public function deleteById($id);

	public function save($input);

	public function getCustomers();

	public function getCustomersLocal();

	public function getAllCustomersSystem();

	public function getTotalEncasement($store_id);
	
}