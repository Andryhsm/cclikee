<?php

namespace App\Interfaces;

interface PageRepositoryInterface
{
    public function getAll();

    public function getById($page_id);

    public function create($input);

    public function updateById($id, $input);

    public function deleteById($id);
}