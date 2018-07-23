<?php
/**
 * Created by PhpStorm.
 * User: Arsenaltech
 * Date: 6/24/2017
 * Time: 12:37 AM
 */

namespace App\Repositories;


use App\Interfaces\FaqRepositoryInterface;
use App\Models\Faq;

class FaqRepository implements FaqRepositoryInterface
{
	protected $model;

	public function __construct(Faq $faq)
	{
		$this->model = $faq;
	}

	public function getAll()
	{
		return $this->model->orderBy('id')->get();
	}

	public function getById($id)
	{
		return $this->model->where('id', $id)->first();
	}

	public function store($input)
	{
		try {
			$this->model->english_question = '';
			$this->model->french_question = $input['french_question'];
			$this->model->english_answer = '';
			$this->model->french_answer = $input['french_answer'];
			$this->model->status = isset($input['status']) ? $input['status'] : '0';
			$this->model->type = isset($input['faq_type']) ? $input['faq_type'] : '0';
			$this->model->save();
			return $this->model;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function updateById($id, $input)
	{
		try {
			$faq = $this->model->findOrNew($id);
			/*$faq->english_question = $input['english_question'];*/
			$faq->french_question = $input['french_question'];
			/*$faq->english_answer = $input['english_answer'];*/
			$faq->french_answer = $input['french_answer'];
			$faq->status = isset($input['status']) ? $input['status'] : '0';
			$faq->type = isset($input['faq_type']) ? $input['faq_type'] : '0';
			$faq->save();
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function deleteById($id)
	{
		return $this->model->destroy($id);
	}

	public function getByType($type)
	{
		return $this->model->where('type',$type)->where('status','1')->orderBy('updated_at','DESC')->get();
	}

}