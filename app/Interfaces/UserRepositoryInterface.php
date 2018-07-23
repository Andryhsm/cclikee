<?php
namespace App\Interfaces;

interface UserRepositoryInterface
{
	public function create($input,$image_name);
	public function getByRole($role_id);
	public function getById($id);
	public function update($id,$input,$image_name);
	public function delete($id);
	public function saveUser($input);
	public function saveUserBySocialMedia($input,$provider);
	public function getCountByRole($role_id);
	public function getDashboardCustomers();
	public function getAllMerchants();

}