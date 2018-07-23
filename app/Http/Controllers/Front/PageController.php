<?php

namespace App\Http\Controllers\Front;

use App\Interfaces\PageRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
	protected $page_repository;

	public function __construct(PageRepositoryInterface $page_repo)
	{
		$this->page_repository = $page_repo;
	}

	public function index($page_id)
	{
		$page = $this->page_repository->getById($page_id);
		if (empty($page)) {
			return Redirect('/');
		}
		return view("front.page.index",compact("page", $page));
	}
	
}
