<?php
namespace App\Repositories;

use App\AttributeSet;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\AffiliateProduct;
use App\Models\ProductTranslation;
use App\Models\ProductStock;
use App\Models\ProductStockAttributeOption;
use App\Product;
use App\ProductAttributeValue;
use App\ProductImage;
use App\Url;
use Illuminate\Support\Facades\Session;
use App\Models\ProductVideo;
use Illuminate\Support\Facades\Auth;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;
    protected $modelAffiliate;
 
    public function __construct(Product $product, AffiliateProduct $affiliate)
    {
        $this->model = $product;
        $this->modelAffiliate = $affiliate;
    }
    
    public function saveArticle($input,$product_images)
    {
        //dd($input);
        try {
            $this->model->brand_name = $input['brand_name'];
            $this->model->is_active = $input['is_active'];
            $this->model->original_price = $input['original_price'];
            $this->model->created_by = Session::get('store_to_user');
            $this->model->store_id = auth()->user()->store->first()->store_id;
            $this->model->attribute_set_id = $input['attribute_set_id'];
            $this->model->range = $input['attribute_set_id'];
            $this->model->balance = "1";
            $this->model->discount = $input['discount'];
            $this->model->promotional_price = $input['promotional_price'];
            $this->model->save();
            
            //product translation
            $product_translation = new ProductTranslation();
            $product_translation->product_id = $this->model->product_id;
            $product_translation->product_name = $input['product_name'];
            $product_translation->description = $input['description'];
			$product_translation->meta_title = $input['product_name'];
			$product_translation->meta_description = $input['brand_name'].''.$input['product_name'];
			$product_translation->meta_advice = $input['meta_advice'];
			$product_translation->user_id = auth()->user()->user_id;
            $product_translation->save();    
            
            //product_stock
            $counts = $input['product_inventory'];
            $status = $input['stock-types'];
            $attributes = $input['attributes'];
            $attribute_id = $input['attribute_id'];
            
            foreach ($counts as $key=>$count) {
                $product_stock = new ProductStock();
                $product_stock->product_id = $this->model->product_id;
                $product_stock->store_id = auth()->user()->store->first()->store_id;
                $product_stock->product_count = $count;
                $product_stock->product_stock_status_id = $status[$key];
                $product_stock->save();
                 
                //product_stock_attribute_option
                foreach ($attributes[$key] as $key1=>$attribute) {
                    $product_stock_attribute_option = new ProductStockAttributeOption();
                    $product_stock_attribute_option->product_stock_id = $product_stock->product_stock_id;
                    $product_stock_attribute_option->attribute_option_id = $attribute;
                    $product_stock_attribute_option->attribute_id = $attribute_id[$key][$key1];
                    $product_stock_attribute_option->save();
                }
            }
            
            //category
            $this->model->categories()->attach($input['categories_id']);
            $this->model->categories()->attach($input['category_child_id']);
            
            //product image
            foreach ($product_images as $index=>$image) {
                $product_image = new ProductImage();
                $product_image->product_id = $this->model->product_id;
                $product_image->image_name = $image;
                $product_image->alt = $input['product_name'];
                $product_image->title = $input['product_name'];
                $product_image->sort_order = $index + 1;
                $product_image->save();
            }
            
            //url
            $url = new Url();
            $url->request_url = $input['product_name'];
            $url->target_url = $input['product_name'];
            $url->type = '2';
            $url->target_id = $this->model->product_id;
            $url->save();
            
            return $this->model;
            
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public function updateArticle($input,$product_images)
    {
        try {
            //product
            $product_id = $input['product_id'];
            $product = $this->model->findOrNew($product_id);
            $product->brand_name = $input['brand_name'];
            $product->is_active = $input['is_active'];
            $product->original_price = $input['original_price'];
            $product->created_by = Session::get('store_to_user');
            $product->store_id = auth()->user()->store->first()->store_id;
            $product->attribute_set_id = $input['attribute_set_id'];
            $product->range = $input['attribute_set_id'];
            $product->balance = "1";
            $product->discount = $input['discount'];
            $product->promotional_price = $input['promotional_price'];
            $product->save();
            
            //translation
            ProductTranslation::updateOrCreate(['product_id' => $product_id],
                [
                    'product_name' => $input['product_name'],
                    'description' => $input['description'],
					'meta_title'=>$input['product_name'],
					'meta_description'=>$input['brand_name'].''.$input['product_name'],
					'meta_advice'=>$input['meta_advice'],
				]
            );
            
            
            //update
            //product_stock
            $counts = $input['product_inventory'];
            $status = $input['stock-types'];
            $attributes = $input['attributes'];
            $attribute_id = $input['attribute_id'];
            $product_stock_ids = $input['product_stock_id'];
            $product_stock_attribute_option_ids = $input['product_stock_attribute_option_id'];
            
            foreach ($counts as $key=>$count) {
                $product_stock = ProductStock::findOrNew($product_stock_ids[$key]);
                $product_stock->product_id = $product_id;
                $product_stock->store_id = auth()->user()->store->first()->store_id;
                $product_stock->product_count = $count;
                $product_stock->product_stock_status_id = $status[$key];
                $product_stock->save();
                 
                //product_stock_attribute_option
                foreach ($attributes[$key] as $key1=>$attribute) {
                    $product_stock_attribute_option = ProductStockAttributeOption::findOrNew($product_stock_attribute_option_ids[$key][$key1]);
                    $product_stock_attribute_option->product_stock_id = $product_stock->product_stock_id;
                    $product_stock_attribute_option->attribute_option_id = $attribute;
                    $product_stock_attribute_option->attribute_id = $attribute_id[$key][$key1];
                    $product_stock_attribute_option->save();
                }
            }
            
            //category
            $product->categories()->detach();
            $product->categories()->attach($input['categories_id']);
            $product->categories()->attach($input['category_child_id']);
            
            //product image
            foreach ($product_images as $index=>$image) {
                $product_image = new ProductImage();
                $product_image->product_id = $product_id;
                $product_image->image_name = $image;
                $product_image->alt = $input['product_name'];
                $product_image->title = $input['product_name'];
                $product_image->sort_order = $index + 1;
                $product_image->save();
            }
            
            return $this->model;
            
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public function save($input)
    {
        try {
            $this->model->brand_id = $input['brand_id'];
            $this->model->is_active = $input['is_active'];
            $this->model->original_price = $input['original_price'];
            $this->model->created_by = Session::get('store_to_user');
            $this->model->save();

            if (!empty($input['fr_product_name']) || !empty($input['fr_description']) ||
				!empty($input['fr_meta_description']) || !empty($input['fr_meta_keywords']) || !empty($input['fr_og_title']) || !empty($input['fr_og_description'])) {
                $product_translation = new ProductTranslation();
                $product_translation->product_id = $this->model->product_id;
                $product_translation->product_name = $input['fr_product_name'];
                $product_translation->summary = $input['fr_summary'];
                $product_translation->description = $input['fr_description'];
				$product_translation->meta_title = $input['fr_title'];
				$product_translation->meta_description = $input['fr_meta_description'];
				$product_translation->meta_keywords = $input['fr_meta_keywords'];
				$product_translation->og_title = $input['fr_og_title'];
				$product_translation->og_description = $input['fr_og_description'];
				$product_translation->user_id = auth()->user()->user_id;
                $product_translation->language_id = '2';
                $product_translation->save();        
            }
            //insert attributes
            if (isset($input['attributes']) && count($input['attributes']) > 0) {
                foreach ($input['attributes'] as $attribute_id => $options) {
                    foreach ($options as $option) {
                        $product_attribute_value = new ProductAttributeValue();
                        $product_attribute_value->product_id = $this->model->product_id;
                        $product_attribute_value->attribute_id = $attribute_id;
                        $product_attribute_value->attribute_option_id = $option;
                        $product_attribute_value->option_value = '';
                        $product_attribute_value->price = 0;
                        $product_attribute_value->per_quantity = '0';
                        $product_attribute_value->sort_order = 0;
                        $product_attribute_value->save();
                    }
                }
            }


            //insert product category data
            if (isset($input['categories_id'])) {
                $categories = explode(',', $input['categories_id']);
                foreach ($categories as $category_id) {
                    $this->model->categories()->attach($category_id);
                }
            }

            //insert product tag data
            if (isset($input['product_tag'])) {
                $tags = explode(',', $input['product_tag']);
                foreach ($tags as $tag_id) {
                    $this->model->tags()->attach($tag_id);
                }
            }


            //store product image
            $product_images = Session::has('product_images') ? Session::get('product_images') : [];

            //Suppression de session image après modification
            if(Session::has('product_images')){
                Session::forget('product_images');
            }

            foreach ($product_images as $index=>$image) {
                $product_image = new ProductImage();
                $product_image->product_id = $this->model->product_id;
                $product_image->image_name = $image;
                $product_image->sort_order = 0;
                $product_image->alt = (!empty($input['image_alt']) && isset($input['image_alt'][$index])) ? $input['image_alt'][$index] : '';
                $product_image->title = (!empty($input['image_title']) && isset($input['image_title'][$index])) ? $input['image_title'][$index] : '';
                $product_image->sort_order = (!empty($input['image_sort_order']) && isset($input['image_sort_order'][$index])) ? $input['image_sort_order'][$index] : '';
                $product_image->save();
            }

            //insert product video
            foreach ($input['videos'] as $video) {
                if (empty($video['value'])) {
                    continue;
                }
                $product_video = new ProductVideo();
                $product_video->video_title = $video['name'];
                $product_video->video_url = $video['value'];
                $product_video->product_id = $this->model->product_id;
                $product_video->save();
            }
            //insert url data
            $url = new Url();
            $url->request_url = $input['product_url'];
            $url->target_url = $input['product_url'];
            $url->type = '2';
            $url->target_id = $this->model->product_id;
            $url->save();

            return $this->model;
            
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public function getAffiliates($product_id)
    {
        return $this->modelAffiliate->where('product_id', $product_id)->orderBy('product_id', 'desc')->get();
    }

    public function updateById($product_id, $input)
    {
        $product = $this->model->findOrNew($product_id);
        $product->brand_id = $input['brand_id'];
        //$product->sku = $input['serial_number'];
        $product->is_active = $input['is_active'];
        $product->original_price = $input['original_price'];
        //$product->best_price = $input['best_price'];
        $product->attribute_set_id = $input['attribute_set'];
        $product->responsible = $input['responsible'];
        //$product->question_note = $input['question_note'];
        //$product->modified_by = auth()->user()->user_id;
        $product->save();


        if (!empty($input['fr_product_name']) || !empty($input['fr_summary']) || !empty($input['fr_description']) || !empty($input['fr_title']) ||
			!empty($input['fr_meta_description']) || !empty($input['fr_meta_keywords']) || !empty($input['fr_og_title']) || !empty($input['fr_og_description'])) {
            ProductTranslation::updateOrCreate(['product_id' => $product_id, 'language_id' => '2'],
                [
                    'product_name' => $input['fr_product_name'],
                    'summary' => $input['fr_summary'],
                    'description' => $input['fr_description'],
					'meta_title'=>$input['fr_title'],
					'meta_description'=>$input['fr_meta_description'],
					'meta_keywords'=>$input['fr_meta_keywords'],
					'og_title'=>$input['fr_og_title'],
					'og_description'=>$input['fr_og_description'],
				]
            );
        }
        //insert attributes
        $new_attribute_option = [];
        $old_attribute_option = isset($input['old_attribute_option_id']) ? explode(',', $input['old_attribute_option_id']) : [];
        if (isset($input['attributes']) && count($input['attributes']) > 0) {
            foreach ($input['attributes'] as $attribute_id => $options) {
                foreach ($options as $option) {
                    $available_options = ProductAttributeValue::where('attribute_id', $attribute_id)->where('attribute_option_id', $option)->where('product_id',$product_id)->first();
                    $new_attribute_option[] = $option;
                    if (isset($available_options) && count($available_options) > 0) {
                        continue;
                    }
                    $product_attribute_value = new ProductAttributeValue();
                    $product_attribute_value->product_id = $product->product_id;
                    $product_attribute_value->attribute_id = $attribute_id;
                    $product_attribute_value->attribute_option_id = $option;
                    $product_attribute_value->option_value = '';
                    $product_attribute_value->price = 0;
                    $product_attribute_value->per_quantity = '0';
                    $product_attribute_value->sort_order = 0;
                    $product_attribute_value->save();
                }
            }
        }

        $removable_option = array_diff($old_attribute_option, $new_attribute_option);

        if (count($removable_option) > 0) {
            ProductAttributeValue::whereIn('attribute_option_id', $removable_option)
                ->where('product_id', $product->product_id)
                ->delete();
        }


        $product->categories()->detach();
        //insert product category data
        if (isset($input['categories_id'])) {
            $categories = explode(',', $input['categories_id']);
            foreach ($categories as $category_id) {
                $product->categories()->attach($category_id);
            }
        }

        $product->tags()->detach();
        //insert product tag data
        if (isset($input['product_tag'])) {
            $tags = explode(',', $input['product_tag']);
            foreach ($tags as $tag_id) {
                $product->tags()->attach($tag_id);
            }
        }

        //store product image

        //Suppression des image de notre produit
        $product_image = new ProductImage();
        $product_image->where('product_id', $product->product_id)->delete();


        $product_images = Session::has('product_images') ? Session::get('product_images') : [];

        //Suppression de session image après modification
        if(Session::has('product_images')){
            Session::forget('product_images');
        }

        foreach ($product_images as $index=>$image) {
            $product_image = new ProductImage();
            $product_image->product_id = $product->product_id;
            $product_image->image_name = $image;
            $product_image->sort_order = 0;
            //	$product_image->title = $product->product_name;
            //dd($product_images);
			$product_image->alt = (!empty($input['image_alt']) && isset($input['image_alt'][$index])) ? $input['image_alt'][$index] : '';
			$product_image->title = (!empty($input['image_title']) && isset($input['image_title'][$index])) ? $input['image_title'][$index] : '';
			$product_image->sort_order = (!empty($input['image_sort_order']) && isset($input['image_sort_order'][$index])) ? $input['image_sort_order'][$index] : '';
			$product_image->save();
        }
         //dd($input);

        //On le commente pour que notre enregistrement se fait à partir du session
      /*  if(!empty($input['product_image_id'])){
        	foreach ($input['product_image_id'] as $index=>$product_image_id){
				$product_image = ProductImage::findOrNew($product_image_id);
				$product_image->alt = (!empty($input['image_alt']) && isset($input['image_alt'][$index])) ? $input['image_alt'][$index] : '';
				$product_image->title = (!empty($input['image_title']) && isset($input['image_title'][$index])) ? $input['image_title'][$index] : '';
				$product_image->sort_order = (!empty($input['image_sort_order']) && isset($input['image_sort_order'][$index])) ? $input['image_sort_order'][$index] : '';
				$product_image->save();
			}
		}*/

        //update product video
        $this->deleteVideoById($product_id);
        //dd($input);
        foreach ($input['videos'] as $video) {
            if (empty($video['value'])) {
                continue;
            }
            $product_video = New ProductVideo();
            $product_video->product_id = $product_id;
            $product_video->video_title = $video['name'];
            $product_video->video_url = $video['value'];
            $product_video->save();
        }

        $url = Url::findOrNew(isset($input['url_id']) ? $input['url_id'] : 0);
        $url->request_url = $input['product_url'];
        $url->target_url = $input['product_url'];
        $url->type = '2';
        $url->target_id = $product->product_id;
        $url->save();

        return $product;

    }

    public function getById($product_id)
    {
        return $this->model->with('translation','admin', 'url', 'images','categories','stocks','stocks.options')->where('product_id', $product_id)->first();
    }

    public function getAll()
    {
        return $this->model->with('french', 'admin', 'tags')->orderBy('product_id', 'desc')->get();
    }

    public function getByStore($store_id){
        return $this->model->with('images','translation','admin', 'tags')->where('store_id', $store_id)->orderBy('product_id', 'desc')->get();
    }

    public function deleteById($product_id)
    {
        $product = $this->model->find($product_id);
        $product->url()->delete();
        $product->images()->delete();
        return $product->delete();
    }

    public function removeMediaByName($image_name)
    {
        unlink(public_path() . 'upload/product/' . $image_name);
        return ProductImage::where('image_name', 'like', $image_name)->delete();
    }

    public function getAttributesBySetId($attribute_set_id)
    {
        return AttributeSet::with('attributes', 'attributes.options', 'attributes.options.french')->where('attribute_set_id', $attribute_set_id)->first();
    }

	public function getAttributesByProductId($product_id)
	{
		return $this->model->with(['attributeValues', 'attributeValues.attribute.translation', 'attributeValues.attribute.options.translation'])->where('product_id', $product_id)->first();
	}

	public function deleteVideoById($product_id)
	{
		return ProductVideo::where('product_id', '=', $product_id)->delete();

	}

	public function getProductVideo($product_id)
	{
		return ProductVideo::where('product_id', $product_id)->get();
	}

	public function getProductById($product_id)
	{
		$base_relationships = [
			'translation',
			'url',
			/*'video',
			'tags',*/
			'categories.translation',
			'images',
			'stocks',
			'stocks.options',
			'stocks.options.option',
			'stocks.options.option.translation',
			'stocks.options.stock',
			'stocks.options.attribute',
			'stocks.options.attribute.translation',
			/*'attributeValues',
			'attributeValues.option',
			'attributeValues.option.translation',
			'attributeValues.attribute',
			'attributeValues.attribute.translation',*/
		];
		return $this->model->with($base_relationships)->where('product_id', $product_id)->whereIsActive(1)->first();
	}

    //Avoir la liste des produit par page
    public function getByCategory($input, $array_store_ids)
    {
        $number_per_page = (array_key_exists('nb', $input)) ? $input['nb'] : \App\Product::DEFAULT_NUMBER_PRODUCT_PAGE;
        $order = (array_key_exists('vp', $input)) ? $input['vp'] :  \App\Product::DEFAULT_ORDER;

        $product_entities = [
            "images",
            "url",
            "brand",
            "brand.parent",
            'attributeValues',
            'attributeValues.attribute',
            'attributeValues.option',
            'attributeValues.option.translation',
        ];
        switch ($order) {
            case '':
                return Product::filter($input, $array_store_ids)->with($product_entities)->select('product.*','product_translation.*')->paginate($number_per_page);
                break;
            case 'low_price_to_high':
                return Product::filter($input, $array_store_ids)->with($product_entities)->select('product.*','product_translation.*')->orderBy('best_price','asc')->paginate($number_per_page);
                break;
            case 'high_price_to_low':
                return Product::filter($input, $array_store_ids)->with($product_entities)->select('product.*','product_translation.*')->orderBy('best_price','desc')->paginate($number_per_page);
                break;
            case 'best_rating':
                return Product::filter($input, $array_store_ids)->with($product_entities)->select('product.*','product_translation.*')->orderBy('rating','desc')->paginate($number_per_page);
                break;
            case 'discount':
                return Product::filter($input, $array_store_ids)->with($product_entities)->select('product.*','product_translation.*')->orderByRaw("(((original_price - best_price) * 100) /original_price) DESC")->paginate($number_per_page);
                break;
            case 'brand_a_z':
                return Product::filter($input, $array_store_ids)->with($product_entities)->select('product.*','product_translation.*')->orderBy('order_brand_by','asc')->paginate($number_per_page);
                break;
            case 'brand_z_a':
                return Product::filter($input, $array_store_ids)->with($product_entities)->select('product.*','product_translation.*')->orderBy('order_brand_by','desc')->paginate($number_per_page);
                break;
            default:
                break;
        }  //list product pagination in catalogue
    }

    //utiliser pour avoir les produits des class_parents(class)

      public function getProductByCategory($input, $array_store_ids)
    {
        $product_entities = [
            "images",
            "url",
            "brand",
            "brand.parent",
            'attributeValues',
            'attributeValues.attribute',
            'attributeValues.option',
            'attributeValues.option.translation',
        ];
        return Product::filter($input, $array_store_ids)->with($product_entities)->select('product.*','product_translation.*')->get();
       

    }

    public function getByCategories($categories)
	{
		$products = Product::join('product_category', function ($query) {
			$query->on('product_category.product_id', '=', 'product.product_id');
		})->with(["images",
			"url",
			"brand",
			"brand.parent",
		])
			->whereIn('product_category.category_id',$categories)
			->groupBy('product.product_id')
			->inRandomOrder()
			->take(15)
			->get();
		return $products;
	}

	public function getByKeyword($keyword, $language_id)
    {
        return ProductTranslation::with(['products', 'products.url', 'products.images'])->where('product_name', 'like', '%' . trim($keyword) . '%')->where('language_id', $language_id)->paginate(48);
    }

    public function getAttributeByProducts($product_ids){
            $attribute_options = ProductAttributeValue::distinct()
                ->with(['option','attribute','option.translation'])
                ->whereIn('product_id', $product_ids)
                ->get();
        return $attribute_options;
    }

    public function getProductByName($name)
    {
        return ProductTranslation::where('product_name', trim($name))->get()->first();
    }

    public function getByBrandsId($brands_id)
    {
		$brands_id = !is_array($brands_id) ? [$brands_id] : $brands_id;
        $merchants = \DB::table('store')
            ->join('store_brands', 'store.store_id', '=', 'store_brands.store_id')
            ->join('store_users', 'store_users.store_id', '=', 'store.store_id')
            ->join('users', 'users.user_id', '=', 'store_users.user_id')
            ->whereIn('store_brands.brand_id', $brands_id)
            ->groupBy('users.user_id')
            ->select('users.*', 'store.latitude', 'store.longitude')
            ->get();
        return $merchants;
    }

    public function getCount()
	{
		return $this->model->count();
	}
	
	public function getCountMerchant($id)
	{
		return $this->model->where('store_id',$id)->count();
	}

	public function getDashboardProduct()
	{
		return $this->model->with('translation','images')->orderBy('product_id','desc')->limit(3)->get();
	}
	public function updateBestPrice($product_id)
	{
		$affiliate_product = AffiliateProduct::where('product_id',$product_id)->min('price');
		$product = $this->model->where('product_id',$product_id)->first();
		if(!empty($affiliate_product) && $product->original_price > $affiliate_product)
		{
			return Product::where('product_id',$product_id)->update(['best_price'=>$affiliate_product]);
		} else {
			return Product::where('product_id',$product_id)->update(['best_price'=>$product->original_price]);
		}
		return;
	}
	
	public function getProductAttributeOption($product_id)
	{
	    return $product_stocks = ProductStock::with('options')->where('product_id', $product_id)->get();
	}
	
	public function getRelatedProductStock($product_id, $attribute_option_id){
	    return $products = \DB::table('product_stock_attribute_option')
          ->join('product_stock', 'product_stock.product_stock_id', '=', 'product_stock_attribute_option.product_stock_id')
 		  ->where('product_stock.product_id',$product_id)
 		  ->where('product_stock_attribute_option.attribute_option_id', $attribute_option_id)
 		  ->get();
	}
	
	public function getRelatedAttributeOption($product_id, $product_stock_ids){
	    return $attributeOptions = ProductStockAttributeOption::with(['option.french'])
          ->join('product_stock', 'product_stock.product_stock_id', '=', 'product_stock_attribute_option.product_stock_id')
          ->join('attribute_option_translation','attribute_option_translation.attribute_option_id', '=', 'product_stock_attribute_option.attribute_option_id')
 		  ->where('product_stock.product_id',$product_id)
          ->where('option_name', '!=', '')
 		  ->whereIn('product_stock_attribute_option.product_stock_id', $product_stock_ids)
 		  ->distinct()->get(['attribute_id', 'product_stock_attribute_option.attribute_option_id', 'option_name']);
	}

    public function deleteMultipleProducts($product_ids){
        foreach ($product_ids as $product_id) {
            $product = $this->model->find($product_id);
            $product->url()->delete();
            $product->images()->delete();
        }
        return $this->model->whereIn('product_id', $product_ids)->delete();
    }
	
}
