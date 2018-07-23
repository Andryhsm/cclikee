<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\TagRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class TagController extends Controller
{
	protected $tag_repository;

	public function __construct(TagRepositoryInterface $tag_repo)
	{
		$this->tag_repository = $tag_repo;
	}

	public function getAll(Request $request)
	{
		$keyword = $request->get('datastring');
		$tags = $this->tag_repository->getByKeyword($keyword);
		return response()->json($tags);
	}

	public function store(Request $request)
	{
		$tag = $this->tag_repository->save($request->all());
		return response()->json($tag);
	}
}
