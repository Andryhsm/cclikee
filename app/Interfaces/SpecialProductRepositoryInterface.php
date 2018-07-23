<?php
namespace App\Interfaces;

interface SpecialProductRepositoryInterface
{
    public function getAll();

    public function create($input);

    public function updateById($id, $input);

    public function deleteById($id);

    public function getProducts($keyword);

    public function getspecialProducts();

}