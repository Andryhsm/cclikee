<?php

namespace App\Repositories;

use App\Interfaces\EmailTemplateRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\EmailTemplate;
use App\Models\EmailTemplateTranslation;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Hash;

class EmailTemplateRepository implements EmailTemplateRepositoryInterface
{
    protected $model;

    public function __construct(EmailTemplate $email_template)
    {
        $this->model = $email_template;
    }

    public function getById($template_id)
    {
        return $this->model->with('english','french')->find($template_id);
    }

    public function getAll()
    {
        return $this->model->with('english')->get();
    }

    public function create($input)
    {
        $this->model->template_name = $input['template_name'];
        $this->model->enable_sms = isset($input['enable_sms']) ? $input['enable_sms'] : 0;
        $this->model->created_by = auth()->guard('admin')->user()->admin_id;
		$this->model->save();

		if(!empty($input['en_subject']) || !empty($input['en_content'])){
			$email_translation = new EmailTemplateTranslation();
			$email_translation->subject = $input['en_subject'];
			$email_translation->content = $input['en_content'];
			$email_translation->sms_content = $input['sms_en_content'];
			$email_translation->language_id = '1';
			$this->model->translation()->save($email_translation);
		}

		if(!empty($input['fr_subject']) || !empty($input['fr_content'])){
			$email_translation = new EmailTemplateTranslation();
			$email_translation->subject = $input['fr_subject'];
			$email_translation->content = $input['fr_content'];
			$email_translation->sms_content = $input['sms_fr_content'];
			$email_translation->language_id = '2';
			$this->model->translation()->save($email_translation);
		}

		return $this->model;
    }

    public function updateById($id, $input)
    {
        $this->model = $this->model->findOrNew($id);
        $this->model->template_name = $input['template_name'];
		$this->model->enable_sms = isset($input['enable_sms']) ? $input['enable_sms'] : 0;
		$this->model->save();
		if(!empty($input['en_subject']) || !empty($input['en_content'])){
			EmailTemplateTranslation::updateOrCreate(['email_template_id'=>$id,'language_id'=>'1'],
				[
					'subject'=>$input['en_subject'],
					'content'=>$input['en_content'],
					'sms_content'=>$input['sms_en_content']
				]
				);
		}

		if(!empty($input['fr_subject']) || !empty($input['fr_content'])){
			EmailTemplateTranslation::updateOrCreate(['email_template_id'=>$id,'language_id'=>'2'],
				[
					'subject'=>$input['fr_subject'],
					'content'=>$input['fr_content'],
					'sms_content'=>$input['sms_fr_content']
				]
			);
		}



		return $this->model;

    }

    public function deleteById($id)
    {
        return $this->model->find($id)->delete();
    }
}