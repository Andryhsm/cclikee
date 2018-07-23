<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\EpartnerRepositoryInterface;
use App\Models\EpartnerMedia;
use App\Service\UploadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class EpartnerController extends Controller
{
	protected $upload_service;
	protected $epartner_repository;

	public function __construct(UploadService $uploadService, EpartnerRepositoryInterface $epartnerRepository)
	{
		$this->upload_service = $uploadService;
		$this->epartner_repository = $epartnerRepository;
	}

	public function index()
	{
		$medias = Datatables::collection($this->epartner_repository->getAll())->make(true);
		$medias = $medias->getData();
		return view('admin.epartner.list', compact('medias'));
	}

	public function create()
	{
		$media = false;
		return view('admin.epartner.form', compact('media'));
	}

	public function store(Request $request)
	{
		$rules = array(
			'name' => 'required',
			'image' => 'mimes:jpeg,jpg,png,gif|max:10000' // max 10000kb
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return redirect()->back()->withInput()->withErrors($validator);
		} else {
			$all_input = $request->all();
			$image_name = "";
			if ($request->hasFile('image')) {
				$file = $request->file('image');
				try {
					$image_name = $this->upload_service->upload($file, EpartnerMedia::IMAGE_PATH);
				} catch (Exception $e) {
					flash()->error($e->getMessage());
					return redirect()->back();
				}
			}
			$all_input['image_name'] = $image_name;
			$this->epartner_repository->save($all_input);
			flash()->success(config('message.epartner.add-success'));
			return redirect('admin/epartner');
		}
	}

	public function edit($id)
	{
		$media = $this->epartner_repository->getById($id);
		return view('admin.epartner.form', compact('media'));
	}

	public function update(Request $request, $id)
	{
		$rules = array(
			'name' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return Redirect::back()->withInput()->withErrors($validator);
		} else {
			$all_input = $request->all();
			$image_name = "";
			if ($request->hasFile('image')) {
				$file = $request->file('image');
				try {
					$image_name = $this->upload_service->upload($file, EpartnerMedia::IMAGE_PATH);
				} catch (Exception $e) {
					flash()->error($e->getMessage());
					return redirect()->back();
				}
			}
			$all_input['image_name'] = $image_name;
			$this->epartner_repository->updateById($id, $all_input);
			flash()->success(config('message.epartner.update-success'));
			return redirect('admin/epartner');
		}
	}

	public function destroy($id)
	{
		if ($this->epartner_repository->deleteById($id)) {
			flash()->success(config('message.epartner.delete-success'));
			return Redirect('admin/epartner');
		}
	}
}
