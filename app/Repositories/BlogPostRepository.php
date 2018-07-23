<?php

namespace App\Repositories;


use App\Interfaces\BlogPostInterface;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Url;
use Carbon\Carbon;

class BlogPostRepository implements BlogPostInterface
{
	protected $model;

	public function __construct(BlogPost $blog_post)
	{
		$this->model = $blog_post;
	}

	public function getAll()
	{
		return $this->model->with('admin', 'category')->orderBy('blog_post_id')->get();
	}

	public function save($input)
	{
		try {
			$this->model->english_title = $input['english_title'];
			$this->model->french_title = $input['french_title'];
			$this->model->english_article = $input['english_article'];
			$this->model->french_article = $input['french_article'];
			$this->model->blog_category_id = $input['blog_category'];
			$this->model->banner_image = $input['blog_image'];
			$this->model->created_by = auth()->guard('admin')->user()->admin_id;
			$this->model->publish_date = $input['publish_date'];
			$this->model->is_active = isset($input['is_active']) ? $input['is_active'] : '0';
			$this->model->is_popular = isset($input['is_popular']) ? $input['is_popular'] : '0';
			$this->model->en_meta_title = $input['en_title'];
			$this->model->fr_meta_title	 = $input['fr_title'];
			$this->model->en_meta_description = $input['en_meta_description'];
			$this->model->fr_meta_description = $input['fr_meta_description'];
			$this->model->en_meta_keywords = $input['en_meta_keywords'];
			$this->model->fr_meta_keywords = $input['fr_meta_keywords'];
			$this->model->en_og_title = $input['en_og_title'];
			$this->model->fr_og_title = $input['fr_og_title'];
			$this->model->en_og_description = $input['en_og_description'];
			$this->model->fr_og_description = $input['fr_og_description'];
			$this->model->save();

			if (isset($input['blog_tag']) && !empty($input['blog_tag'])) {
				$blog_tags = explode(',', $input['blog_tag']);
				foreach ($blog_tags as $tag) {
					$this->model->tags()->attach($tag);
				}
			}

			if(!empty($input['related_post']))
			{
				foreach ($input['related_post'] AS $related_post_id){
					$this->model->relatedPosts()->attach($related_post_id);
				}
			}

			$url = new Url();
			$url->request_url = $input['url'];
			$url->target_url = $input['url'];
			$url->type = '4';
			$url->target_id = $this->model->blog_post_id;
			$url->save();

			return $this->model;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function updateByUpdate($blog_post_id, $input)
	{
		try {
			$blog_post = $this->model->findOrNew($blog_post_id);
			$blog_post->english_title = $input['english_title'];
			$blog_post->french_title = $input['french_title'];
			$blog_post->english_article = $input['english_article'];
			$blog_post->french_article = $input['french_article'];
			$blog_post->blog_category_id = $input['blog_category'];
			if (!empty($input['blog_image'])) {
				$blog_post->banner_image = $input['blog_image'];
			}
			$blog_post->is_active = isset($input['is_active']) ? $input['is_active'] : '0';
			$blog_post->is_popular = isset($input['is_popular']) ? $input['is_popular'] : '0';
			$blog_post->en_meta_title = $input['en_title'];
			$blog_post->fr_meta_title	 = $input['fr_title'];
			$blog_post->en_meta_description = $input['en_meta_description'];
			$blog_post->fr_meta_description = $input['fr_meta_description'];
			$blog_post->en_meta_keywords = $input['en_meta_keywords'];
			$blog_post->fr_meta_keywords = $input['fr_meta_keywords'];
			$blog_post->en_og_title = $input['en_og_title'];
			$blog_post->fr_og_title = $input['fr_og_title'];
			$blog_post->en_og_description = $input['en_og_description'];
			$blog_post->fr_og_description = $input['fr_og_description'];
			$blog_post->publish_date = $input['publish_date'];
			$blog_post->save();

			$blog_post->tags()->detach();
			if (isset($input['blog_tag']) && !empty($input['blog_tag'])) {
				$blog_tags = explode(',', $input['blog_tag']);
				foreach ($blog_tags as $tag) {
					$blog_post->tags()->attach($tag);
				}
			}

			$blog_post->relatedPosts()->detach();
			if(!empty($input['related_post']))
			{
				foreach ($input['related_post'] AS $related_post_id){
					$blog_post->relatedPosts()->attach($related_post_id);
				}
			}


			$url = Url::findOrNew(isset($input['url_id']) ? $input['url_id'] : 0);
			$url->request_url = $input['url'];
			$url->target_url = $input['url'];
			$url->type = '4';
			$url->target_id = $blog_post->blog_post_id;
			$url->save();

			return $blog_post->model;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function deleteById($blog_post_id)
	{
		return $this->model->destroy($blog_post_id);
	}

	public function getById($blog_post_id)
	{
		return $this->model->with('tags','relatedPosts','url')->where('blog_post_id', $blog_post_id)->first();
	}

	public function getAllPostWithPagination($param=null)
	{
		$query = $this->model->with('admin', 'tags')->where('is_active','1');
		if(!empty($param) && isset($param['category']))
		{
			$query->where('blog_category_id',$param['category']);
		}
		$query->where('publish_date','<=',Carbon::now()->format('Y-m-d'));
		if(!empty($param) && isset($param['tag']))
		{
			$query->whereHas('tags',function ($q) use($param) {
				$q->where('blog_tag.blog_tag_id',$param['tag']);
			});
		}

			return $query->paginate(BlogPost::PAGE_LIMIT);
	}

	public function byIdWithDetail($blog_post_id)
	{
		return $this->model->with('admin','tags','url','relatedPosts')
			->where('blog_post_id',$blog_post_id)
			->where('is_active','1')
			->first();
	}

	public function getPopularPost()
	{
		return $this->model->with('admin', 'tags','url')->where('is_active','1')->where('is_popular','1')->where('publish_date','<=',Carbon::now()->format('Y-m-d'))->get();
	}
	public function getHomePagePost()
	{
		return BlogCategory::with([
			'posts'=>function ($query) {
			$query->where('is_active', '1');
			$query->where('publish_date','<=', Carbon::now()->format('Y-m-d'));
		},
			'posts.admin'
		])->where('is_home_page','1')->get();
	}

}