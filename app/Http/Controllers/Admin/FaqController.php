<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FaqRequest;
use App\Interfaces\FaqRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
	protected $faq_repository;

	public function __construct(FaqRepositoryInterface $faq_repo)
	{
		$this->faq_repository = $faq_repo;
	}

	public function index()
	{
		$faqs = \Datatables::collection($this->faq_repository->getAll())->make(true);
		$faqs = $faqs->getData();
		return view('admin.faq.list', compact('faqs'));
	}

	public function create()
	{
		$faq = false;
		return view('admin.faq.form', compact('faq'));
	}

	public function store(FaqRequest $faq_request)
	{
		$faq = $this->faq_repository->store($faq_request->all());
		flash()->success(config('message.faq.add-success'));
		return redirect()->route('faq.index');
	}


	public function edit($id)
	{
		$faq = $this->faq_repository->getById($id);
		return view('admin.faq.form', compact('faq'));
	}

	public function update(FaqRequest $faq_request, $id)
	{
		$faq = $this->faq_repository->updateById($id, $faq_request->all());
		flash()->success(config('message.faq.update-success'));
		return redirect()->route('faq.index');
	}

	public function destroy($id)
	{
		$status = $this->faq_repository->deleteById($id);
		if ($status) {
			flash()->success(config('message.faq.delete-success'));
		} else {
			flash()->error(config('message.faq.delete-error'));
		}
		return redirect()->route('faq.index');
	}


}
