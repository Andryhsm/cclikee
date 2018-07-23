<?php

namespace App\Http\Controllers\Front;

use App\Interfaces\BlogCategoryInterface;
use App\Interfaces\BlogPostInterface;
use App\Interfaces\BlogTagInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
	protected $blog_repository;
	protected $blog_category_repository;
	protected $blog_tag_repository;

	public function __construct(BlogPostInterface $blog_repo, BlogCategoryInterface $blog_category_repo, BlogTagInterface $blog_tag_repo)
	{
		$this->blog_repository = $blog_repo;
		$this->blog_category_repository = $blog_category_repo;
		$this->blog_tag_repository = $blog_tag_repo;
	}

	public function allPost(Request $request)
	{
		$param = $request->all();
		$posts = $this->blog_repository->getAllPostWithPagination($param);
		$popular_posts = $this->blog_repository->getPopularPost();
		$tags = $this->blog_tag_repository->getAll();
		return view('front.blog.list', compact('posts', 'tags','popular_posts'));
	}

	public function show($blog_id)
	{
		$post = $this->blog_repository->byIdWithDetail($blog_id);
		$blog_categories = $this->blog_category_repository->getAllActive();
		$popular_posts = $this->blog_repository->getPopularPost();
		$blog_tags = $this->blog_tag_repository->getAll();
		return view('front.blog.show',compact('post','blog_categories','blog_tags','popular_posts'));
	}
}
