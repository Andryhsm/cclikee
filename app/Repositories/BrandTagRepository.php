<?php
/**
 * Created by PhpStorm.
 * User: Chirag
 * Date: 5/5/2017
 * Time: 7:12 AM
 */

namespace App\Repositories;


use App\BrandTag;
use App\Interfaces\BrandTagRepositoryInterface;
use App\Models\BrandCategory;

class BrandTagRepository implements BrandTagRepositoryInterface {

    public function __construct(BrandTag $tag)
    {
        $this->model = $tag;
    }

    public function getByKeyword($keyword)
    {
        return $this->model->where('tag_name', 'like', "%$keyword%")->get();
    }

    public function save($input)
    {
        $this->model->tag_name = $input['tag'];
        $this->model->save();
        return $this->model;
    }

    public function deleteById($tag_id)
	{
		return $this->model->destroy($tag_id);
	}
}