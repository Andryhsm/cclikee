<?php
/**
 * Created by PhpStorm.
 * User: Chirag
 * Date: 4/22/2017
 * Time: 9:17 AM
 */

namespace App\Interfaces;


interface AdminRoleRepositoryInterface
{

    public function create($input);

    public function update($id, $input);

    public function delete($id);

    public function getAll();

}