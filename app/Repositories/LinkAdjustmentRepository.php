<?php

namespace App\Repositories;

use App\Interfaces\LinkAdjustmentRepositoryInterface;
use App\Models\LinkAdjustment;
use App\User;
use App\UserAddress;
use Illuminate\Support\Facades\Hash;

class LinkAdjustmentRepository implements LinkAdjustmentRepositoryInterface
{
    protected $model;

    public function __construct(LinkAdjustment $link_adjustment)
    {
        $this->model = $link_adjustment;
    }

    public function getByRole($role_id)
    {
        return User::where('role_id', '=', $role_id)->get();
    }

    public function getById($id)
    {
        return LinkAdjustment::with('user')->whereLinkAdjustmentId($id)->get()->first();
    }

    public function getAll()
    {
        return LinkAdjustment::with('user')->get();
    }

    public function create($input)
    {
        $this->model->user_id = $input['user_id'];
        $this->model->link = $input['link'];
        $this->model->description = $input['description'];
        return $this->model->save();
    }

    public function updateById($id, $input)
    {

        $link_adjustmenr = $this->model->findOrNew($id);
        $link_adjustmenr->user_id = $input['user_id'];
        $link_adjustmenr->link = $input['link'];
        $link_adjustmenr->description = $input['description'];
        return $link_adjustmenr->save();
    }

    public function deleteById($id)
    {
        return $this->model->find($id)->delete();
    }
}