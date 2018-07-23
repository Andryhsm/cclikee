<?php
namespace App\Repositories;


use App\Attribute;
use App\AttributeOption;
use App\Interfaces\AttributeRepositoryInterface;
use App\Models\AttributeOptionTranslation;
use App\Models\AttributeTranslation;

class AttributeRepository implements AttributeRepositoryInterface
{
	protected $model;

	public function __construct(Attribute $attribute)
	{
		$this->model = $attribute;
	}

	public function getAll()
	{
		return $this->model->with('english','french','admin')->orderBy('attribute_id', 'desc')->get();
	}

	public function save($input)
	{
		$this->model->type = $input['input_type'];
		$this->model->is_required = (isset($input['is_required'])) ? $input['is_required'] : 0;
		$this->model->created_by = auth()->guard('admin')->user()->admin_id;
		$this->model->save();

		/*if(isset($input['en_attribute_name']) && !empty($input['en_attribute_name'])){*/
			$translation = new AttributeTranslation();
			$translation->attribute_name = '';
			$translation->language_id = '1';
			$this->model->translation()->save($translation);
		/*}*/

		if(isset($input['fr_attribute_name']) && !empty($input['fr_attribute_name'])){
			$translation = new AttributeTranslation();
			$translation->attribute_name = $input['fr_attribute_name'];
			$translation->language_id = '2';
			$this->model->translation()->save($translation);
		}

		$i = 1;

		foreach ($input['options'] as $attribute) {			
			$attribute_option = new AttributeOption();
			$attribute_option->attribute_num = $i;
			$attribute_option->option_value = $attribute['value'];
			$attribute_option->sku = null;
			$attribute_option->color_code = $attribute['value'];
			$attribute_option->sort_order = 0;
			$option = $this->model->options()->save($attribute_option);

			/*if(isset($attribute['en_name']) && !empty($attribute['en_name'])){*/
				$option_translation = new AttributeOptionTranslation();
				$option_translation->option_name = '';
				$option_translation->language_id = '1';
				$option_translation->attribute_translation_num = $i;
				$option->translation()->save($option_translation);
			/*}*/
			if(isset($attribute['fr_name']) && !empty($attribute['fr_name'])){
				$option_translation = new AttributeOptionTranslation();
				$option_translation->option_name = $attribute['fr_name'];
				$option_translation->language_id = '2';
				$option_translation->attribute_translation_num = $i;
				$option->translation()->save($option_translation);
			}

			$i++;
		}
		return $this->model;
	}

	public function updateById($attribute_id, $input)
	{
		$attribute = $this->model->findOrNew($attribute_id);
		
		$attribute->type = $input['input_type'];
		$attribute->is_required = (isset($input['is_required'])) ? $input['is_required'] : 0;
		$attribute->save();

		/*if(isset($input['en_attribute_name']) && !empty($input['en_attribute_name'])){
			AttributeTranslation::updateOrCreate(['attribute_id'=>$attribute_id,'language_id'=>'1'],
				['attribute_name'=>$input['en_attribute_name'],'language_id'=>'1']
			);
		}*/

		if(isset($input['fr_attribute_name']) && !empty($input['fr_attribute_name'])){
			AttributeTranslation::updateOrCreate(['attribute_id'=>$attribute_id,'language_id'=>'2'],
				['attribute_name'=>$input['fr_attribute_name'],'language_id'=>'2']
			);
		}

		$i = 1;

		$new_options = [];
		$old_option = isset($input['old_options']) ? explode(',',$input['old_options']) : [];
		foreach ($input['options'] as $option) {
			if(isset($option['attribute_option_id']))
			{
				$new_options[] = $option['attribute_option_id'];
			}

			$attribute_option = AttributeOption::findOrNew(isset($option['attribute_option_id']) ?$option['attribute_option_id']:0);
			$attribute_option->attribute_num = $i;	
			$attribute_option->option_value = $option['value'];
			$attribute_option->sku = null;
			$attribute_option->color_code = $option['value'];
			$attribute_option->sort_order = 0;
			$attr_option = $attribute->options()->save($attribute_option);

			/*if(isset($option['en_name']) && !empty($option['en_name'])){
				AttributeOptionTranslation::updateOrCreate(['attribute_option_id'=>$attr_option->attribute_option_id,'language_id'=>'1'],['option_name'=>$option['en_name'],'language_id'=>'1','attribute_translation_num'=>$i]
					);
			}*/
			if(isset($option['fr_name']) && !empty($option['fr_name'])){
				AttributeOptionTranslation::updateOrCreate(['attribute_option_id'=>$attr_option->attribute_option_id,'language_id'=>'2'],['option_name'=>$option['fr_name'],'language_id'=>'2','attribute_translation_num'=>$i]
					);
			}

			$i++;
		}

		$removable_option = array_diff($old_option,$new_options);

		if(count($removable_option)>0){
			AttributeOption::whereIn('attribute_option_id',$removable_option)
				->delete();
		}
		return $attribute;
	}

	public function getById($attribute_id)
	{
		return $this->model->with('translation','options','options.english','options.french')
			->where('attribute_id', $attribute_id)
			->first();
	}

	public function deleteById($attribute_id)
	{
		return $this->model->where('attribute_id', $attribute_id)
			->delete();
	}
}