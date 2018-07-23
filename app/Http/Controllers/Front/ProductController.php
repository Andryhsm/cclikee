<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderSave;
use App\Interfaces\ProductRatingRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\StoreRepositoryInterface;
use App\Models\AffiliateProduct;
use App\Models\Brand;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemAttribute;
use App\Models\OrderStatusHistory;
use App\Models\OrderTransaction;
use App\Models\ProductRating;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    //
    protected $product_repository;
    protected $product_rating_repository;
    protected $client;
    const CACHE_TIME_FOR_PRODUCT = 1440;

    public function __construct(ProductRepositoryInterface $product_repository, ProductRatingRepositoryInterface $product_rating_repository, UserRepositoryInterface $user_repository)
    {
        $this->product_repository = $product_repository;
        $this->product_rating_repository = $product_rating_repository;
        $this->client = new Client();
        $this->user_repository = $user_repository;
    }
    public function index($product_id)
	{
	    
        $parent_category = [];
        $product = $this->product_repository->getProductById($product_id);
        $attributes=$this->product_repository->getAttributesByProductId($product_id);
        $product_attributes['attribute_value'] = $product_attributes['attribute_option'] = [];
        $product_attributes = $this->getProductAttribute($attributes->attributeValues);
        $all_reviews = $this->product_rating_repository->getApprovedAllReview($product_id);
        $reviews = $this->product_rating_repository->getApprovedReview($product_id);
        $total_ratings = $this->product_rating_repository->getApprovedRating($product_id);
        $average_rating = count($all_reviews) > 0 ?round($total_ratings/count($all_reviews)): 0;
        $affiliate_products = AffiliateProduct::whereProductId($product_id)->orderBy('price','ASC')->take(7)->get();
        if ($product == null) {
            return Redirect::to('/');
        }
        $categories = $product->categories;
        $categories_id = $product->categories->pluck('category_id')->all();
    	$related_products = $this->product_repository->getByCategories($categories_id);
        $attribute_set = $this->product_repository->getAttributesBySetId($product->attribute_set_id);
        
        $product_attribute_options = $this->product_repository->getProductAttributeOption($product_id);

        $attribute_option_ids = [];
        foreach ($product_attribute_options as $value) {
            foreach($value->options as $option){
                if(!in_array($option->attribute_option_id,$attribute_option_ids)){
                    $attribute_option_ids[] = $option->attribute_option_id;
                }
    	    }
        }

        return view('front.product.index')
            ->with('product', $product)
            ->with('affiliate_products', $affiliate_products)
            ->with('reviews', $reviews)
            ->with('average_rating', $average_rating)
            ->with('attribute_value', $product_attributes['attribute_value'])
            ->with('attr_options', $product_attributes['attr_options'])
            ->with('related_products', $related_products)
            ->with('attribute_option_id', $product_attributes['attribute_option'])
            ->with('categories', $categories)
            ->with('attribute_set', $attribute_set)
            ->with('attribute_option_ids',$attribute_option_ids);
    }

    public function getProductAttribute($attribute_values)
    {
        $language_id = app('language')->language_id;
        $attribute_value = $attribute_option_id = $attr_options = [];
        foreach ($attribute_values as $attrs) {
            $attribute_data = $attrs->attribute->translation->filter(function ($value, $key) use ($language_id) {
                return ($value->language_id == $language_id);
            });
            $attribute_data = (count($attribute_data) == 0) ? $attrs->attribute->translation : $attribute_data;
            if ($attrs->attribute->type == 1) {
                if (count($attribute_data) > 0) {
					$attr_options[$attribute_data->first()->attribute_id][] = $attrs->attribute_option_id;
					$attribute_value[$attribute_data->first()->attribute_id] = ['id' => $attribute_data->first()->attribute_id,
                        'name' => $attribute_data->first()->attribute_name,
                        'type' => $attrs->attribute->type,
                        'options' => $attrs->attribute->options,
                        'attribute_option_id' => $attrs->attribute_option_id,
                        'product_attribute_option_id' => $attrs->product_attribute_option_id
                    ];
                }

            }
            $attribute_option_id[] = $attrs->attribute_option_id;
            if ($attrs->attribute->type == 2) {
                if (!empty($attribute_data) && count($attribute_data) > 0) {
					$attr_options[$attribute_data->first()->attribute_id][] = $attrs->attribute_option_id;
                    $attribute_value[$attribute_data->first()->attribute_id] = ['id' => $attribute_data->first()->attribute_id,
                        'name' => $attribute_data->first()->attribute_name,
                        'type' => $attrs->attribute->type,
                        'options' => $attrs->attribute->options,
                        'attribute_option_id' => $attrs->attribute_option_id,
                        'product_attribute_option_id' => $attrs->product_attribute_option_id
                    ];
                }
            }
        }
        return ['attribute_value' => $attribute_value, 'attribute_option' => $attribute_option_id,'attr_options'=>$attr_options];
    }

    public function submitReview(Request $request)
    {
        $is_review_exists = $this->product_rating_repository->getReviewById($request);
        if ($is_review_exists > 0) {
            return response()->json(['success' => false, "message" => ProductRating::ALREADY_SUBMIT_REVIEW]);
        }
        try {
            $this->product_rating_repository->save($request);
            $message = ProductRating::SUCCESS_MESSAGE;
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return response()->json(['success' => true, "message" => $message]);
    }

    public function getDistance(Request $request)
    {
        $zip = ($request->has('zip_code')) ? $request->get('zip_code') :'' ;
        $requested_distance = ($request->has('requested_distance')) ? $request->get('requested_distance') : '';
        $product_id = $request->get('product_id');
        $product = $this->product_repository->getById($product_id);
        try {
            $url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($zip) . "&sensor=false";
            $result_string = file_get_contents($url);
            $result = json_decode($result_string, true);
            $result1[] = $result['results'][0];
            $location = $result1[0]['geometry']['location'];
            $result2[] = $result1[0]['geometry'];
            $result3[] = $result2[0]['location'];
            $stores = (!empty($product->brand) && !empty($product->brand->stores())) ?$product->brand->stores()->get():[];
            foreach ($stores as $store) {
                $distance = $this->calculateDistance($store->latitude, $store->longitude, $location['lat'], $location['lng']);
                //distance==5Km and requested_distance==10;
                if ($requested_distance >= $distance) {
                    return response()->json(['success' => true, 'message' => trans('product.product_available')]);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => trans('product.invalid_address')]);
        }
        return response()->json(['success' => false, 'message' => trans('product.product_not_available')]);
    }

    public function calculateDistance($lat1, $lon1, $lat2, $lon2, $decimals = 1)
    {
        $theta = $lon1 - $lon2;
        $distance = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        $distance = $distance * 1.609344;
        return round($distance, $decimals);
    }

    public function askProduct()
    {
        return view('front.product.ask_product')->with('keyword', '')->with('sort_by', '');
    }

    public function searchProduct(Request $request)
    {
        $keyword = $request->get('keyword');
		$ask_product = \Session::pull('ask-product');
        $products = [];
        $sort_by=\Cache::get('sort_by');
        if (\Cache::has('product_search_' . $keyword)) {
            $products = \Cache::get('product_search_' . $keyword);
        } else {
            //$returnXML = $this->getCommissionApiProduct($keyword);
            $results = $this->getAmazonProduct($keyword);
            if (!empty($results['Items']['Item'])) {
            	if(!empty($results['Items']['TotalResults']) && $results['Items']['TotalResults']=='1'){
					$items = array($results['Items']['Item']);
				} else {
					$items = $results['Items']['Item'];
				}
                foreach ($items as $key => $result) {
                    $description = '';
                    if (isset($result['ItemAttributes']['Feature']) && is_array($result['ItemAttributes']['Feature'])) {
                        foreach ($result['ItemAttributes']['Feature'] as $feature) {
                            $description .= $feature;
                        }
                    } else {
                        $description .= (!empty($result['ItemAttributes']['Feature'])) ? $result['ItemAttributes']['Feature'] : '';
                    }
                    $products[$key]['name'] = $result['ItemAttributes']['Title'];
                    $products[$key]['sort_order'] = $key;
                    $products[$key]['description'] = $description;
                    $products[$key]['price'] = getProductPrice($result);;
                    $products[$key]['sort_price'] = trim(str_replace('CDN$', '', $products[$key]['price']));
                    $products[$key]['DetailPageURL'] = $result['DetailPageURL'];
                    $products[$key]['image_url'] = (!empty($result['MediumImage']['URL'])) ? $result['MediumImage']['URL'] : '';
                    $products[$key]['advertiser_name'] = 'amazon.ca';
                }
            }
            $index = (count($products) > 0) ? count($products) - 1 : 0;
           /* if(!empty($returnXML['products']['product'])){
                foreach ($returnXML['products']['product'] as $key => $product) {
                    $products[$index]['image_url'] = (!empty($product['image-url'])) ? $product['image-url'] : '';
                    $products[$index]['DetailPageURL'] = $product['buy-url'];
                    $products[$index]['description'] = $product['description'];
                    $products[$index]['price'] = format_price($product['price']);
                    $products[$index]['sort_price'] = $product['price'];
                    $products[$index]['name'] = $product['name'];
                    $products[$index]['advertiser_name'] = $product['advertiser-name'];
                    $index++;
                }
            }*/
            \Cache::put('product_search_' . $keyword, $products, self::CACHE_TIME_FOR_PRODUCT);
        }
		$brands = Brand::with('parent')->active()->get();
		return view('front.product.ask_product', compact('keyword', 'sort_by','brands','ask_product'))->with('products', $products)->with('is_display', '1');
    }

    public function getAmazonProduct($keyword)
    {
        try {
            $results = \Amazon::search($keyword)->json();
        } catch (Exception $e) {
                dd($e->getResponse()->getBody()->getContents());
        }
        return $results;
    }

    public function getCommissionApiProduct($keyword)
    {
        $products=[];
        try {
            $res = $this->client->request('GET', 'https://product-search.api.cj.com/v2/product-search?website-id=8224756&keywords=' . $keyword, [
                'headers' => ['Authorization' => "00be644e6e12d5803026e49f5c3370cf4738569afaf3a87fff0dd19d6702c597eb9d84e996edc472c6130bfa08619633f85eb5fcf231d824f275ad9f1f0093539f/191529e8027f322625d994cd16d1d3dcf42524c1cefbf1f0ee27216f82c3f9618cdb0ca0e7c4c998057a91d1d8fd5be5235e2e845d578698af7211c43b679d11"]
            ]);
            $returnXML = simplexml_load_string($res->getBody());
            $products = json_decode(json_encode($returnXML), 1);
        } catch (\Exception $e) {
            //$returnXML = [];
        }
        return $products;
    }

    public function productExistsInLocal(Request $request){
        $product_brands = $request->get('product_brands');
        $zip_code = $request->get('zip_code');
        $requested_distance = $request->get('radius');
        $merchants = $this->product_repository->getByBrandsId($product_brands);
        if (empty($merchants) || empty($zip_code)) {
            return response()->json(['success' => '0', 'message' => trans('ask_product.no_product_found')]);
        }
        $location = $this->getLatitudeAndLongitudeByZipCode($zip_code);
        $merchant_available = false;
        foreach ($merchants as $merchant) {
            $distance = $this->calculateDistance($merchant->latitude, $merchant->longitude, $location['lat'], $location['lng']);
            //distance==5Km and requested_distance==10;
            if ($requested_distance >= $distance) {
                $merchant_available = true;
                $merchants=$this->user_repository->getById($merchant->user_id);
              //  \Event::fire(New NotifyMerchant($merchants));
            }
        }
        if($merchant_available && !\Auth::check())
        {
        	\Session::put('ask-product',$request->all());
			return response()->json(['success' => '2', 'message' => trans('ask_product.login_text')]);
		}
        if ($merchant_available) {
            $this->saveOrder($request);
            return response()->json(['success' => '1', 'message' => trans('common/label.thank_you_order')]);
        } else {
			return response()->json(['success' => '0', 'message' => trans('ask_product.no_product_found')]);
		}
    }

    public function saveOrder($request){
        $order=New Order();
        $order->user_id = \Auth::id();
        $order->order_date = Carbon::now();
        $order->order_status_id = OrderItem::ORDER_STATUS_ORDERED;
        $order->subtotal = $request->get('reduce_price');
        $order->discount = 0;
        $order->tax = 0;
        $order->total = $request->get('reduce_price');
        $order->is_type = 1;
        $order->save();

        $order_item = new OrderItem();
        $order_item->product_id = $request->get('product_name');
        $order_item->brand_id = $request->get('product_brands')[0];
        $order_item->product_name = $request->get('product_name');
        $order_item->product_sku = NULL;
        $order_item->quantity = 1;
        $order_item->price = $request->get('reduce_price');
        $order_item->discount = 0;
        $order_item->final_price = $request->get('reduce_price');
        $order_item->attribute_sku = '';
        $order_item->attribute_price = 0;
        $order_item->tax = 0;
        $order_item->radius = $request->get('radius');
        $order_item->zip_code = $request->get('zip_code');
		$order_item->order_status_id = OrderItem::ORDER_STATUS_ORDERED;
		$order_item->product_url = $request->get('product_url');
        $order->orderItems()->save($order_item);

		if(!empty($request->get('product_color'))){
			$order_item_attribute = new OrderItemAttribute();
			$order_item_attribute->attribute_label = "Color";
			$order_item_attribute->attribute_name = "Color";
			$order_item_attribute->attribute_selected_value = $request->get('product_color');
			$order_item->attributes()->save($order_item_attribute);
		}
		if(!empty($request->get('product_size'))){
			$order_item_attribute = new OrderItemAttribute();
			$order_item_attribute->attribute_label = "Size";
			$order_item_attribute->attribute_name = "Size";
			$order_item_attribute->attribute_selected_value = $request->get('product_size');
			$order_item->attributes()->save($order_item_attribute);
		}

		$order_transaction = new OrderTransaction();
        $order_transaction->order_id = $order->order_id;
        $order_transaction->payment_method = 'Cash';
        $order_transaction->amount = $request->get('reduce_price');
        $order_transaction->created_at = Carbon::now();
        $order_transaction->save();

        $order_status_history = new OrderStatusHistory();
        $order_status_history->order_id = $order->order_id;
        $order_status_history->order_item_id = null;
        $order_status_history->order_status_id = OrderItem::ORDER_STATUS_ORDERED;
        $order_status_history->status_name = 'On Going';
        $order_status_history->comments = "New Order Placed";
        $order_status_history->user_id = \Auth::id();
        $order_status_history->user_name = \Auth::user()->first_name." ".\Auth::user()->last_name;
        $order_status_history->created_at = Carbon::now();
        $order_status_history->save();
    }

    public function getSortByPrice(Request $request)
    {
        $keyword = $request->get('keyword');
        $sort_by = ($request->get('sort_by') == 'asc') ? SORT_ASC : SORT_DESC;
        if (\Cache::has('product_search_' . $keyword)) {
            $products = \Cache::get('product_search_' . $keyword);
        }
        array_multisort(array_column($products, 'sort_price'), $sort_by, $products);
        \Cache::put('product_search_' . $keyword, $products, self::CACHE_TIME_FOR_PRODUCT);
        \Cache::put('sort_by', $request->get('sort_by'), self::CACHE_TIME_FOR_PRODUCT);
        return view('front.product.ask_product', compact('keyword'))->with('products', $products)->with('is_display', '1')->with('sort_by',$request->get('sort_by'));
    }

    public function removeProduct(Request $request)
    {
        $keyword = $request->get('keyword');
        $sort_order=$request->get('sectionsid');
        $products = \Cache::get('product_search_' . $keyword);
		if(\Cache::has('product_search_'.$keyword)){
			$sort_products=[];
			foreach($sort_order as $key=>$value){
                if(isset($products[$value])){
                    $sort_products[$value] = $products[$value];
				}
			}
            \Cache::put('product_search_'.$keyword, $sort_products, self::CACHE_TIME_FOR_PRODUCT);
   	    }
	}

    public function getLatitudeAndLongitudeByZipCode($zip_code)
    {
        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($zip_code) . "&sensor=false";
        $result_string = file_get_contents($url);
        $result = json_decode($result_string, true);
        if($result['status'] != "ZERO_RESULTS"){
            $result1[] = $result['results'][0];
            $location = $result1[0]['geometry']['location'];
        }else{
            $location = "notfound";
        }
        return $location;
    }

   public function getOptions(Request $request)
   {
       $product_id = $request->get('product_id');
       $attribute_option_id = $request->get('attribute_option_id');
       $products = $this->product_repository->getRelatedProductStock($product_id, $attribute_option_id);
       $product_stock_ids = [];
       foreach ($products as $product) {
          $product_stock_ids[] = $product->product_stock_id; 
       }
       $atribute_options = $this->product_repository->getRelatedAttributeOption($product_id, $product_stock_ids); 
      
       return response ()->json ($atribute_options);
   }
}
