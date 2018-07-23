<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\BlogTagInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogTagController extends Controller
{
	protected $blog_tag_repository;

	public function __construct(BlogTagInterface $blog_tag_repo)
	{
		$this->blog_tag_repository = $blog_tag_repo;
	}

	public function get(Request $request)
	{
		$keyword = $request->get('datastring');
		$tags = $this->blog_tag_repository->getByKeyword($keyword);
		return response()->json($tags);
	}

	public function store(Request $request)
	{
		$tag = $this->blog_tag_repository->save($request->all());
		return response()->json($tag);
	}
}
