<?php
namespace App\Repositories;

use App\Models\Radio;

class RadioRepository
{
    protected $model;

    public function __construct(Radio $radio)
    {
        $this->model = $radio;
    }

    public function getById($radio_id)
    {
        return $this->model->find($radio_id);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function create($input)
    {

        $this->model->name = $input['name'];
        $this->model->url = $input['url'];
        $this->model->zip = $input['zip'];
        return $this->model->save();
    }

    public function updateById($id, $input)
    {
        $this->model = $this->model->findOrNew($id);
        $this->model->name = $input['name'];
        $this->model->url = $input['url'];
        $this->model->zip = $input['zip'];
        return $this->model->save();
    }

    public function deleteById($id)
    {
        return $this->model->find($id)->delete();
    }
    
    public function findRadio($zip)
    {
        return $this->model->where('zip',$zip)->inRandomOrder()->first();
    }

}