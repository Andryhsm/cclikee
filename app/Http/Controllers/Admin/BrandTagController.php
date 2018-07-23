<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\BrandTagRepositoryInterface;
use App\Models\BrandCategory;
use App\Repositories\BrandTagRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class BrandTagController extends Controller
{
	protected $brand_tag_repository;

	public function __construct(BrandTagRepositoryInterface $brand_tag_repo)
	{
		$this->brand_tag_repository = $brand_tag_repo;
	}

	public function getAll(Request $request)
	{
		$keyword = $request->get('datastring');
		$tags = $this->brand_tag_repository->getByKeyword($keyword);
		return response()->json($tags);
	}

	public function store(Request $request)
	{
		$tag = $this->brand_tag_repository->save($request->all());
		return response()->json($tag);
	}

	public function destroy(Request $request)
	{
		$tag_id = $request->get('tag');
		$status = $this->brand_tag_repository->deleteById($tag_id);
		return response()->json($status);
	}

}
