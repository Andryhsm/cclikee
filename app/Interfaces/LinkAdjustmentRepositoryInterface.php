<?php
namespace App\Interfaces;

interface LinkAdjustmentRepositoryInterface
{
    public function create($input);

    public function getByRole($role_id);

    public function getById($id);

    public function getAll();

    public function updateById($id, $input);

    public function deleteById($id);
}