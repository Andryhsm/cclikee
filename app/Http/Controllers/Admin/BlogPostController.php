<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogPostRequest;
use App\Interfaces\BlogCategoryInterface;
use App\Interfaces\BlogPostInterface;
use App\Models\BlogPost;
use App\Service\UploadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogPostController extends Controller
{
	protected $blog_post_repository;
	protected $blog_category_repository;
	protected $upload_service;

	public function __construct(BlogPostInterface $blog_post_repo, BlogCategoryInterface $blog_category_repo, UploadService $uploadService)
	{
		$this->blog_post_repository = $blog_post_repo;
		$this->blog_category_repository = $blog_category_repo;
		$this->upload_service = $uploadService;
	}

	public function index()
	{
		$posts = \Datatables::collection($this->blog_post_repository->getAll())->make(true);
		$posts = $posts->getData();
		return view('admin.blog.list', compact('posts'));
	}

	public function create()
	{
		$post = false;
		$categories = $this->blog_category_repository->getAll();
		$blog_categories = [''=>'Select Blog Category'];
		foreach ($categories as $category) {
			$blog_categories[$category->blog_category_id] = $category->english_name;
		}
		return view('admin.blog.form', compact('post', 'blog_categories'));
	}

	public function store(BlogPostRequest $blog_post_request)
	{
		$all_input = $blog_post_request->all();
		$image_name = $this->uploadImage();
		$all_input['blog_image'] = $image_name;
		$post = $this->blog_post_repository->save($all_input);
		flash()->success(config('message.blog-post.add-success'));
		return redirect()->route('blog.index');
	}

	public function update(BlogPostRequest $blog_post_request, $blog_post_id)
	{
		$all_input = $blog_post_request->all();
		$image_name = $this->uploadImage();
		$all_input['blog_image'] = $image_name;
		$post = $this->blog_post_repository->updateByUpdate($blog_post_id, $all_input);
		flash()->success(config('message.blog-post.update-success'));
		return redirect()->route('blog.index');
	}

	public function edit($blog_post_id)
	{
		$categories = $this->blog_category_repository->getAll();
		$blog_categories = [''=>'Select Blog Category'];
		foreach ($categories as $category) {
			$blog_categories[$category->blog_category_id] = $category->english_name;
		}
		$post = $this->blog_post_repository->getById($blog_post_id);
		return view('admin.blog.form', compact('post','blog_categories'));
	}

	public function destroy($blog_post_id)
	{
		$status = $this->blog_post_repository->deleteById($blog_post_id);
		if ($status) {
			flash()->success(config('message.blog-post.delete-success'));
		} else {
			flash()->error(config('message.blog-post.delete-error'));
		}
		return redirect()->route('blog.index');

	}

	public function uploadImage()
	{
		$image_name = "";
		if (\Input::hasFile('blog_image')) {
			$file = \Input::file('blog_image');
			try {
				$image_name = $this->upload_service->upload($file, BlogPost::IMAGE_PATH_C);
			} catch (Exception $e) {
				flash()->error($e->getMessage());
				return \Redirect::back();
			}

			$img = \Image::make(public_path().'/'.BlogPost::IMAGE_PATH_C.$image_name);
			//$image_name = str_replace(' ', '_', $image_name) ;						
			//$image_name = strval(mt_rand());											//genêre un nom aléatoire pour renommer l'image
			//$image_name .= ".png";

			//$img->save(BlogPost::IMAGE_PATH_C.$image_name);
			$thumb_path = public_path(BlogPost::IMAGE_PATH_C.'thumb');
			
			if(!\File::isDirectory($thumb_path)){
				\File::makeDirectory($thumb_path);
			}

			$img->heighten(280)->save($thumb_path.'/'.$image_name);

		}
		return $image_name;
	}

	public function getPost(Request $request)
	{
		$keyword = $request->get('datastring');
		$posts = BlogPost::where('english_title','like',"%$keyword%")->get();
		return response()->json($posts);
	}

}
