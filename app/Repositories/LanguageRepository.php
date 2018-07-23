<?php

namespace App\Repositories;


use App\Interfaces\LanguageInterface;
use App\Models\Language;

class LanguageRepository implements LanguageInterface
{
	protected $model;

	public function __construct(Language $language)
	{
		$this->model = $language;
	}

	public function getAll()
	{
		return $this->model->get();
	}

	public function getOptions()
	{
		$languages = $this->getAll();
		$return = [];
		foreach ($languages as $language) {
			$return[$language->language_id] = $language->language_name;
		}
		return $return;
	}
}