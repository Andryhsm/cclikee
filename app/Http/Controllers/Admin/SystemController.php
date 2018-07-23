<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
	protected $model;
	public function __construct(Setting $setting)
	{
		$this->model = $setting;
	}

	public function index()
	{
		$english_settings = $this->model->where('language_id','1')->get();
		$french_settings = $this->model->where('language_id','2')->get();



		$thumb_path = public_path(\App\Product::PRODUCT_IMAGE_PATH.'thumb');
		//dd($thumb_path);


		
		return view('admin.system.form',compact('english_settings','french_settings'));
	}

	public function store(Request $request)
	{
		$inputs = $request->all();
		foreach ($inputs['setting'] as $language_id=>$settings)
		{
			foreach ($settings as $key=>$value)
			{
				$this->model->where('language_id',$language_id)->where('name',$key)->update(['value'=>$value]);
			}
		}
		flash()->success("System settings updated successfully.");
		return redirect()->to('admin/system');
	}

}
