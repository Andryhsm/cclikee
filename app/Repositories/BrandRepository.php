<?php namespace App\Repositories;


use App\BrandTag;
use App\Interfaces\BrandRepositoryInterface;
use App\Models\Brand;
use App\Models\BrandCategory;

class BrandRepository implements BrandRepositoryInterface
{

    function __construct(Brand $couponCode)
    {
        $this->model = $couponCode;
    }


    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function create($input, $image_name)
    {
        $this->model->brand_name = $input['brand_name'];
        $this->model->website = $input['website'];
        $this->model->is_active = isset($input['is_active']) ? $input['is_active'] : '1';
        $this->model->created_by = auth()->guard('admin')->user()->admin_id;
        if (!empty($image_name)) {
            $this->model->brand_image = $image_name;
        }
        $this->model->save();

		if(!empty($input['main_brand_tag'])){
			$main_brand_tags = explode(',',$input['main_brand_tag']);
			foreach ($main_brand_tags as $tag){
				$this->model->tags()->attach($tag);
			}
		}

		if(!empty($input['sub_brand']) && !empty($input['sub_brand'][0]))
		{
			foreach ($input['sub_brand'] as $index => $sub_brand){
				$brand = new Brand();
				$brand->brand_name = $sub_brand;
				$brand->website = $input['website'];
				$brand->is_active = 1;
				$brand->parent_id = $this->model->brand_id;
				$brand->created_by = auth()->guard('admin')->user()->admin_id;
				$brand->save();

				if(isset($input['sub_brand_tag']) && !empty($input['sub_brand_tag'][$index])){
					$sub_brand_tags = explode(',',$input['sub_brand_tag'][$index]);
					foreach ($sub_brand_tags as $tag){
						$brand->tags()->attach($tag);
					}
				}
			}
		}
        return $this->model;

    }

    public function update($id, $input, $image_name)
    {
        $brand = $this->model->findOrNew($id);
        $brand->brand_name = $input['name'];
        $brand->order_brand_by = $input['name'];
        $brand->website = $input['website'];
        $brand->is_active = isset($input['is_active']) ? $input['is_active'] : '1';
        if (!empty($image_name)) {
            $brand->brand_image = $image_name;
        }
        $brand->save();

		$brand->tags()->detach();
		if(!empty($input['main_brand_tag'])){
			$main_brand_tags = explode(',',$input['main_brand_tag']);
			foreach ($main_brand_tags as $tag){
				$brand->tags()->attach($tag);
			}
		}

		$new_brand = [];
		$old_brand = isset($input['old_sub_brand_id']) ? explode(',',$input['old_sub_brand_id']) : [];
		if(!empty($input['sub_brand']) && !empty($input['sub_brand'][0]))
		{
			foreach ($input['sub_brand'] as $index => $sub_brand_value){
				$id= (isset($input['sub_brand_id']) && !empty($input['sub_brand_id'][$index]))?$input['sub_brand_id'][$index]:0;
				if(isset($input['sub_brand_id']) && !empty($input['sub_brand_id'][$index])){
					$new_brand[] = $input['sub_brand_id'][$index];
				}
				$sub_brand = Brand::findOrNew($id);
				$sub_brand->brand_name = $sub_brand_value;
				$sub_brand->website = $input['website'];
				$sub_brand->is_active = 1;
				$sub_brand->parent_id = $brand->brand_id;
				$sub_brand->order_brand_by = $brand->brand_name;
				$sub_brand->save();
				$sub_brand->tags()->detach();
				if(isset($input['sub_brand_tag']) && !empty($input['sub_brand_tag'][$index])){
					$sub_brand_tags = explode(',',$input['sub_brand_tag'][$index]);
					foreach ($sub_brand_tags as $tag){
						$sub_brand->tags()->attach($tag);
					}
				}
			}
		}

		$removable_brand = array_diff($old_brand,$new_brand);

		if(count($removable_brand)>0){
			Brand::whereIn('brand_id',$removable_brand)
				->delete();
		}
	}
 
    public function get()
    {
        return $this->model->with('parent','admin')->get();
    }

	public function getById($brand_id)
	{
		return $this->model->where('brand_id', $brand_id);
	}

    public function getAll()
    {
        return $this->model->where('parent_id',null)->orderByRaw("RAND()")->get();
    }
    
    public function lists()
	{
		$brands = Brand::with('parent')->leftJoin('brand AS sub_brand','brand.parent_id','=','sub_brand.brand_id')
			->where('brand.is_active','1')
			->orderBy('brand_name')
			->select(\DB::raw("brand.brand_id,CASE WHEN brand.parent_id IS NULL THEN brand.brand_name ELSE CONCAT(sub_brand.brand_name,' ',brand.brand_name) END AS brand_name,brand.parent_id"))
			->get();
			//dd($brands);
		return $brands;
	}
}