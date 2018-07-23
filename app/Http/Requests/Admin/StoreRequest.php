<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
/*			'shop_name'=>'Required',
			'registration_number'=>'Required',
			'address1'=>'Required',
			'city'=>'Required',
			'zip'=>'Required',
			'main_phone'=>'Required',
			'main_email'=>'Required',
*/
		];
    }
}
