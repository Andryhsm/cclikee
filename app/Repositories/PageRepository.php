<?php

namespace App\Repositories;

use App\Interfaces\PageRepositoryInterface;
use App\Models\Page;
use App\Models\PageTranslation;
use App\Url;
use Illuminate\Support\Facades\Hash;

class PageRepository implements PageRepositoryInterface
{
    protected $model;

    public function __construct(Page $page)
    {
        $this->model = $page;
    }

    public function getAll()
    {
        return $this->model->with('french')->get();
    }

    public function getById($page_id)
    {
        return Page::with('english','french')->where('page_id',$page_id)->get()->first();
    }

    public function create($input)
    {
        $this->model->status = isset($input['is_active']) ? $input['is_active'] : '0';
        $this->model->layout = '1';
        $this->model->created_by = auth()->guard('admin')->user()->admin_id;
        $this->model->save();


		if(!empty($input['en_page_title']) || !empty($input['en_content_heading']) || !empty($input['en_content']) || !empty($input['en_title']) ||
			!empty($input['en_meta_description']) || !empty($input['en_meta_keywords']) || !empty($input['en_og_title']) || !empty($input['en_og_description']))
		{
			$page_translation = new PageTranslation();
			$page_translation->page_title = $input['en_page_title'];
			$page_translation->content_heading = $input['en_content_heading'];
			$page_translation->content = $input['en_content'];
			$page_translation->meta_title = $input['en_title'];
			$page_translation->meta_description = $input['en_meta_description'];
			$page_translation->meta_keywords = $input['en_meta_keywords'];
			$page_translation->og_title = $input['en_og_title'];
			$page_translation->og_description = $input['en_og_description'];
			$page_translation->language_id = '1';
			$this->model->translation()->save($page_translation);
		}

		if(!empty($input['fr_page_title']) || !empty($input['fr_content_heading']) || !empty($input['fr_content']) || !empty($input['fr_title']) ||
			!empty($input['fr_meta_description']) || !empty($input['fr_meta_keywords']) || !empty($input['fr_og_title']) || !empty($input['fr_og_description']))
		{
			$page_translation = new PageTranslation();
			$page_translation->page_title = $input['fr_page_title'];
			$page_translation->content_heading = $input['fr_content_heading'];
			$page_translation->content = $input['fr_content'];
			$page_translation->meta_title = $input['fr_title'];
			$page_translation->meta_description = $input['fr_meta_description'];
			$page_translation->meta_keywords = $input['fr_meta_keywords'];
			$page_translation->og_title = $input['fr_og_title'];
			$page_translation->og_description = $input['fr_og_description'];
			$page_translation->language_id = '2';
			$this->model->translation()->save($page_translation);
		}

		$url = new Url();
        $url->request_url = $input['url_key'];
        $url->target_url = $input['url_key'];
        $url->type = '3';
        $url->target_id = $this->model->page_id;
        $url->save();
        return $this->model;

    }

    public function updateById($id, $input)
    {
        $this->model = $this->model->findOrNew($id);
        $this->model->status = isset($input['is_active']) ? $input['is_active'] : '0';
        $this->model->layout = '1';
        $this->model->created_by = auth()->guard('admin')->user()->admin_id;
        $this->model->save();

		if(!empty($input['en_page_title']) || !empty($input['en_content_heading']) || !empty($input['en_content']) || !empty($input['en_title']) ||
			!empty($input['en_meta_description']) || !empty($input['en_meta_keywords']) || !empty($input['en_og_title']) || !empty($input['en_og_description']))
		{
			PageTranslation::updateOrCreate(['page_id'=>$id,'language_id'=>'1'],
				[
					'page_title'=>$input['en_page_title'],
					'content_heading'=>$input['en_content_heading'],
					'content'=>$input['en_content'],
					'meta_title'=>$input['en_title'],
					'meta_description'=>$input['en_meta_description'],
					'meta_keywords'=>$input['en_meta_keywords'],
					'og_title'=>$input['en_og_title'],
					'og_description'=>$input['en_og_description'],
				]);
		}

		if(!empty($input['fr_page_title']) || !empty($input['fr_content_heading']) || !empty($input['fr_content']) || !empty($input['fr_title']) ||
			!empty($input['fr_meta_description']) || !empty($input['fr_meta_keywords']) || !empty($input['fr_og_title']) || !empty($input['fr_og_description']))
		{
			PageTranslation::updateOrCreate(['page_id'=>$id,'language_id'=>'2'],
				[
					'page_title'=>$input['fr_page_title'],
					'content_heading'=>$input['fr_content_heading'],
					'content'=>$input['fr_content'],
					'meta_title'=>$input['fr_title'],
					'meta_description'=>$input['fr_meta_description'],
					'meta_keywords'=>$input['fr_meta_keywords'],
					'og_title'=>$input['fr_og_title'],
					'og_description'=>$input['fr_og_description'],
				]);
		}

		$url = Url::findOrNew(isset($input['url_id']) ? $input['url_id'] : 0);
        $url->request_url = $input['url_key'];
        $url->target_url = $input['url_key'];
        $url->type = '3';
        $url->target_id = $this->model->page_id;
        $url->save();
        return $this->model;
    }

    public function deleteById($id)
    {

        return $this->model->find($id)->delete();
    }
}