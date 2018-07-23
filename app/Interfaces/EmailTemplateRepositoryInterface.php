<?php

namespace App\Interfaces;

interface EmailTemplateRepositoryInterface
{
    public function getAll();

    public function getById($template_id);

    public function create($input);

    public function updateById($id, $input);

    public function deleteById($id);
}