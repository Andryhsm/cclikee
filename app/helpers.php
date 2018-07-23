<?php
/**
 * Global helpers file with misc functions
 **/
if (!function_exists('app_name')) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }

}

if (!function_exists('set_active')) {

    /**
     * @param        $path
     * @param string $active
     * @return string
     */
    function set_active($path, $active = 'active')
    {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }
}

if (!function_exists('request_is_in')) {

    /**
     * @param        $path
     * @param string $active
     * @return string
     */
    function request_is_in($path, $active = true)
    {
        return call_user_func_array('Request::is', (array)$path) ? $active : false;
    }
}

if (!function_exists('formatDate')) {

    /**
     * @param $date
     * @return string
     */
    function formatDate($date)
    {
        return Carbon\Carbon::parse($date)->format('m/d/Y');
    }

    /**
     * @param $amount
     * @return string
     */
    function format_price($amount)
    {
        if ($amount == 0) {
            return '0.00 <i class="fa fa-eur" aria-hidden="true"></i>';
        } else {
            return number_format((float)$amount, 2). '<i class="fa fa-eur" aria-hidden="true"></i>';
        }
    }

    /**
     * @param $amount
     * @param $percentage
     * @return string
     */
    function calculateDiscount($amount,$percentage)
    {
        if ($amount == 0) {
            return 'Free';
        } else {
            return  number_format($amount - (($amount * $percentage) / 100),2);
        }
    }

    /**
     * @param $amount
     * @param $percentage
     * @return string
     */
    function calculateDiscountAmount($amount,$percentage)
    {
        if ($amount == 0) {
            return 'Free';
        } else {
            return  number_format((($amount * $percentage) / 100),2);
        }
    }

    /**
     * @param $length
     * @return string
     */
    function random($length)
    {
        $original_string = implode("", array_merge(range(0, 9), range('A', 'Z')));
        return substr(str_shuffle($original_string), 0, $length);
    }
}

if (!function_exists('pre')) {

    /**
     * @param $data
     */
    function pre($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}

if (!function_exists('postDateFormat')) {

    /**
     * @param $date
     * @return string
     */
    function postDateFormat($date)
    {
        return \Carbon\Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');
    }
}

if (!function_exists('formatBirthDate')) {

    /**
     * @param $date
     * @return string
     */
    function formatBirthDate($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('m-d-Y');
    }
}
if (!function_exists('setBooleanArrayList')) {

    /**
     * @return array
     */
    function setBooleanArrayList()
    {
        return ['1' => 'Yes', '0' => 'No'];
    }
}
if (!function_exists('conditionList')) {

    /**
     * @return array
     */
    function conditionList()
    {
        return ['' => 'Select', '1' => 'Only discount Custom Words', '0' => 'Only discount these Favorite Words'];
    }
}
if (!function_exists('applyOnList')) {

    /**
     * @return array
     */
    function applyOnList()
    {
        return ['' => 'Select', '1' => 'Fixed Amount', '0' => 'Percentage'];
    }
}
if (!function_exists('alphabetLetterArray')) {

    /**
     * @return array
     */
    function alphabetLetterArray()
    {
        return ['A' => 'A', 'B' => 'C', '0' => 'Percentage'];
    }
}
if (!function_exists('changeColorArray')) {

    /**
     * @return array
     */
    function changeColorArray()
    {
        return [''=>'All','1' => 'Color', '2' => 'GrayScale'];
    }
}

if (!function_exists('getFavouriteCategoryList')) {

    /**
     * @return array
     */
    function getFavouriteCategoryList()
    {
        $category_lists = \DB::table('favourite_category')->lists('category_name','favourite_category_id');
        return ['' => '- Select Favorite Category -'] + $category_lists ;
    }
}
if (!function_exists('getFavouriteCategories')) {

    /**
     * @return array
     */
    function getFavouriteCategories()
    {
        return \DB::table('favourite_category')->lists('category_name','favourite_category_id');

    }
}

if (!function_exists('getImages')) {

    /**
     * @return array
     */
    function getImages($image_ids)
    {
        return \App\Models\Image::whereIn('image_id',$image_ids)->get();
    }
}

if (!function_exists('checkWeekends')) {


    /**
     * @param $date
     * @return mixed
     */
    function checkWeekends($date)
    {
        $now = \Carbon\Carbon::now();
        while($now <= $date)
        {
            if($now->dayOfWeek === \Carbon\Carbon::SATURDAY){
                $now->addDays(2);
                $date->addDays(2);
            }elseif($now->dayOfWeek === \Carbon\Carbon::SUNDAY){
                $now->addDays(1);
                $date->addDays(1);
            }
            $now->addDay();
        }
        return $date;
    }
}

if (!function_exists('convertDateTime')) {


    /**
     * @param $date
     * @return string
     */
    function convertDateTime($date)
    {
       return  \Carbon\Carbon::parse($date)->format('m/d/Y h:i A');
    }
}

if(!function_exists('imageWatermark')){

    function imageWatermark($image){
        // Remove the extension from the filename
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $image = basename($image,".".$ext);

        // Create the common name for the watermarked image
        $watermarked_image_name = 'images/watermark/watermark-'.$image.'.png';

        // Check if we have already created the watermarked images
        $exist =  file_exists(public_path($watermarked_image_name));
        if($exist){
            return asset($watermarked_image_name);
        }else{
            $watermark = Image::make(asset('images/copyright.png'))->resize(600,900);
            $image= Image::make('images/upload/product/'.$image.".".$ext)->insert($watermark,'center')->save($watermarked_image_name);
            chmod(($image->dirname.'/'.$image->basename),0644);
            return asset($image->dirname.'/'.$image->basename);
        }
    }
}

if (!function_exists('thumbImageWatermark')) {
    function thumbImageWatermark($image)
    {
        // Remove the extension from the filename
        $ext   = pathinfo($image, PATHINFO_EXTENSION);
        $image = basename($image, "." . $ext);

        // Create the common name for the watermarked image
        $thumbnail_image_name = 'images/watermark/thumb/' . $image . '.png';
        // Check if we have already created the watermarked images
        $exist = file_exists(public_path($thumbnail_image_name));
        if ($exist) {
            return asset($thumbnail_image_name);
        } else {
            $image = Image::make('images/watermark/' . $image . '.png')->resize(125, 188)->save($thumbnail_image_name);
            chmod(($image->dirname . '/' . $image->basename), 0644);

            return asset($image->dirname . '/' . $image->basename);
        }
    }
}


if (!function_exists('thumbProductImage')) {
    function thumbProductImage($image_name)
    {
        // Remove the extension from the filename
        $ext   = pathinfo($image_name, PATHINFO_EXTENSION);
        $image = basename($image_name, "." . $ext);

        // Create the common name for the thumb image
        $thumbnail_image_name = 'images/upload/product/thumb/' . $image_name;
        // Check if we have already created the thumbnail images
        $exist = file_exists(public_path($thumbnail_image_name));
        if ($exist) {
            return asset($thumbnail_image_name);
        } else {
            $image = Image::make(public_path('images/upload/product/'. $image_name))->resize(125, 188)->save($thumbnail_image_name);
            chmod(($image->dirname . '/' . $image->basename), 0644);

            return asset($image->dirname . '/' . $image->basename);
        }
    }
}


if (!function_exists('getLength')) {


    /**
     * @param $string
     * @return int
     */
    function getLength($string)
    {
        return  strlen(str_replace(' ', '', $string));
    }
}
if (!function_exists('getDeliveryDate')) {

    function getDeliveryDate($estimated_date)
    {
        return $estimated_date->min_delivery_time . " - " . $estimated_date->max_delivery_time;
    }
}

if (!function_exists('encryptString')) {

    function encryptString($string)
    {
        return Crypt::encrypt($string);
    }
}
if (!function_exists('decryptString')) {
    /**
     * @param $string
     * @return string
     */
    function decryptString($string)
    {
        return Crypt::decrypt($string);
    }
}


/**
 * @param $id
 * @param $array
 * @return null
 */
if (!function_exists('searchForLetter')) {
    function searchForLetter($id, $array)
    {
        $final = "";
        foreach ($array as $key => $val) {
            if ($val->alphabet_letter === $id) {
                $final[] = $val;
            }
        }
        return $final;
    }
}

if (!function_exists('changeFileExtension')) {
    function changeFileExtension($filename)
    {
        return str_replace(array(".jpg",".JPG"),array(".png",".png"),$filename);
    }
}

if (!function_exists('copyrightImage')) {
    function copyrightImage($start_year)
    {
        $string = "&copy; Copyright ";
        $string .= date('Y');
        $string .= " <a href=\"http://www.whatsthewordshop.com\" target=\"_blank\" style=\"color:#fff; text-decoration:none;\">What's the Word?</a>";
        return stripslashes($string);
    }
}

if(!function_exists('prepareLetterArray'))
{
    function prepareLetterArray()
    {
        $letter_arr = [];
        $letter_arr[''] = " - Select Alphabet Letter -";
        foreach (range('A', 'Z') as $v) {
            $letter_arr [$v] = $v;
        }
        return $letter_arr;
    }

}


if(!function_exists("getImageNameWithoutExtension"))
{
    function getImageNameWithoutExtension($image){
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        return basename($image,".".$ext);
    }
}

if (!function_exists('convertDate')) {


    /**
     * @param $date
     * @return string
     */
    function convertDate($date)
    {
        return  \Carbon\Carbon::parse($date)->format('F j, Y');
    }
}

function getPrice($price,$symbol='$'){
    return $symbol.$price;
}

function checkRouteExists($route, $route_name)
{
    if (in_array($route_name, $route)) {
        return true;
    }
    return false;
}


if (!function_exists('check_route_exists')) {

    /**
     * @param        $path
     * @param string $active
     * @return string
     */
    function check_user_access($route)
    {
        if(!is_array($route))
            $route = array($route);
        foreach($route as $path){
            if (in_array($path, app('user_permission'))) {
                return true;
            }
        }
        return false;
    }

    function check_merchant_access($route)
    {
        /*if(!is_array($route))
            $route = array($route);
        foreach($route as $path){
            if (in_array($path, app('user_permission'))) {
                return true;
            }
        }*/
        return true;
    }
}

function getRebate($best_price, $original_price)
{
	$rebate = $original_price - $best_price;
	return number_format(($rebate*100)/$original_price,2).'%';
}

function videoType($url)
{
    return (strpos($url, 'youtube') > 0) ? 'youtube' : 'unknown';
}

function getProductPrice($product,$symbol='CDN$')
{
    $price = $symbol.'0.00';
    if (!empty($product['Offers']['Offer'])) {
        $price = $product['Offers']['Offer']['OfferListing']['Price']['FormattedPrice'];
    } else if (!empty($product['OfferSummary']['LowestNewPrice'])) {
        $price = $product['OfferSummary']['LowestNewPrice']['FormattedPrice'];
    } elseif (!empty($product['OfferSummary']['LowestUsedPrice'])) {
        $price = $product['OfferSummary']['LowestUsedPrice']['FormattedPrice'];
    } elseif (!empty($product['ItemAttributes']['ListPrice'])) {
        $price = $product['ItemAttributes']['ListPrice']['FormattedPrice'];
    }
    return $price;
}

function getCategories($categories, $category_parent_id,$selected_category)
{
    echo '<ul class="nav navbar-nav grid-container--fit">';
    $index = 1;
    foreach ($categories as $category) {
        if (!empty($category['title'])) {
            $selected_class= ($selected_category==$category['key'] || $category_parent_id==$category['key']) ? 'selected' : '';
            echo "<li class='dropdown menu-large ".$selected_class."'> ";
            //Si la categorie est séléctionner dans le menu7
            if($selected_category==$category['key']){
                get_product_types_copie($category['children']);
            }
            
            $cat_title = strtolower(str_replace(' ', '-', $category['title']));
            echo "<a id='parent_category".$index."' data-id='" . $category['key'] . "' href='#' onclick='stopEvent()' class='dropdown-toggle arrow-bottom $selected_class' data-toggle='dropdown' data-parent='#" . $category['title'] . "' data-type='category-filter'>" . $category['french_title'] . "</a>";  
            if (!empty($category['children'])) {
                getChildCategory($category['children'], $category_parent_id, $selected_category, $cat_title);
            } 
            
            echo "</li>";
        $index ++;
            
        }
    }
    echo '</ul>';
}
function getChildCategory($categories, $category_parent_id,$selected_category,$name)
{
    $index = 0;
    $nb = sizeof($categories);
    
	echo  '<ul class="'.$name.' dropdown-menu megamenu row">
	        <li class="container ptb-10">';
    foreach ($categories as $category) {
        if($index == 0){
            $selected_class=($selected_category==$category['parent_ids'])?'selected':'';
            $title_all = ($category['parent_ids'] == 782 || $category['parent_ids'] == 781 || $category['parent_ids'] == 783) ? "Toute la collection" : "Tout";
            echo '<div class=" mt-5 mb-10">'; 
            echo "<a data-id='' href='#' onclick='window.location.href=\"".route('search', ['category' => $category['parent_ids']])."\"'  class='filter $selected_class' data-toggle='collapse' data-parent-ids='' data-parent='#' data-type='category-filter'> ".$title_all." </a> 
                  ";  
            echo '</div>';
            $index++;
        }
        if (!empty($category['title'])) {
            $cat_title = strtolower(str_replace(' ', '-', $category['title']));
            $selected_class=($selected_category==$category['key'])?'selected':'';
            echo '<div class=" mt-5 mb-10">';
            echo "<a data-id='" . $category['key'] . "' href='#' onclick='window.location.href=\"".route('search', ['category' => $category['key']])."\"'  class='filter $selected_class' data-toggle='collapse' data-parent-ids='".$category['parent_ids']."' data-parent='#" . $cat_title . "' data-type='category-filter'>" . $category['french_title'] . "</a> 
                  ";   
            echo '</div>';
            if($selected_category==$category['key']){
                get_product_types_copie($category['children']);
                $selected_class =  'selected';  
            }
            /*if (!empty($category['children'])) {
                echo getChildCategory($category['children'], $category_parent_id, $selected_category, $cat_title);
            }*/
            
        }
    }
    echo " </li> 
           </ul>";
}

function get_product_types_copie($category_children){
    if(!empty($category_children)){
        echo "<div class='hidden' id='product_types_copie'>";
        foreach($category_children as $category){
            echo '<a class="filter" data-id="'.$category['key'].'" href="#"><div class="dropdown-item">'.$category['french_title'].'<i class="fa fa-circle-o pull-right"></i></div></a>';
        } 
        echo "</div>";
        
    }
}

function parse_youtube($link)
{
    $regexstr = '~
            # Match Youtube link and embed code
            (?:                             # Group to match embed codes
                (?:<iframe [^>]*src=")?       # If iframe match up to first quote of src
                |(?:                        # Group to match if older embed
                    (?:<object .*>)?      # Match opening Object tag
                    (?:<param .*</param>)*  # Match all param tags
                    (?:<embed [^>]*src=")?  # Match embed tag to the first quote of src
                )?                          # End older embed code group
            )?                              # End embed code groups
            (?:                             # Group youtube url
                https?:\/\/                 # Either http or https
                (?:[\w]+\.)*                # Optional subdomains
                (?:                         # Group host alternatives.
                youtu\.be/                  # Either youtu.be,
                | youtube\.com              # or youtube.com
                | youtube-nocookie\.com     # or youtube-nocookie.com
                )                           # End Host Group
                (?: /watch\?v= | \S*[^\w\-\s])?           # Extra stuff up to VIDEO_ID
                ([\w\-]{11})                # $1: VIDEO_ID is numeric
                [^\s]*                      # Not a space
            )                               # End group
            "?                              # Match end quote if part of src
            (?:[^>]*>)?                       # Match any extra stuff up to close brace
            (?:                             # Group to match last embed code
                </iframe>                 # Match the end of the iframe
                |</embed></object>          # or Match the end of the older embed
            )?                              # End Group of last bit of embed code
            ~ix';

    preg_match($regexstr, $link, $matches);
    if (isset($matches[1]))
        return $matches[1];
    return 0;
}

function getPercentage($original_price,$best_price)
{
	return "-".number_format((($original_price - $best_price)*100)/$original_price,0).'%';
}

function getRadiusData()
{
	return ['5'=>'5 KM','10'=>'10 KM','15'=>'15 KM','20'=>'20 KM','35'=>'35 KM','50'=>'50 KM','100'=>'100 KM'];
}

function getCommission($amount)
{
	return number_format((($amount*\App\Models\Invoice::COMMISSION_PERCENTAGE)/100),2);
}

function getAvailableHours()
{
	return ['24h'=>'24h','48h'=>'48h','72h'=>'72h','4 days'=>'4 days','5 days'=>'5 days','6 days'=>'6 days','7 days'=>'7 days'];
}

function getLatitudeAndLongitudeByZipCode($zip_code, $country)
{
    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );
	$url = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAYvJI_Ul_xb9kOGHOtHJ9odVD43OcGz0s&address=" . urlencode($zip_code) . "+".$country."&sensor=false";
	$result_string = file_get_contents($url, false, stream_context_create($arrContextOptions));
	$result = json_decode($result_string, true);
	$result1[] = $result['results'][0];
	$location = $result1[0]['geometry']['location'];
	return $location;
}

function calculateDistance($lat1, $lon1, $lat2, $lon2, $decimals = 1)
{
	$theta = $lon1 - $lon2;
	$distance = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
	$distance = acos($distance);
	$distance = rad2deg($distance);
	$distance = $distance * 60 * 1.1515;
	$distance = $distance * 1.609344;
	return round($distance, $decimals);
}

function getMerchantCount($item)
{
	$count = 0;
	
	//dd($item->brand->item);
	
	dd($item->product->store);
	
	$location = getLatitudeAndLongitudeByZipCode($item['zip_code']);
	foreach ($item->brand->stores as $store) {
		$distance = calculateDistance($store->latitude, $store->longitude, $location['lat'], $location['lng']);
		if ($item['radius'] >= $distance) {
			$count += 1;
		}
	}
	return $count;
}


function getCouponExpiryDate($item)
{
	$time = ['24h'=>'1','48h'=>'2','72h'=>'3','4 days'=>'4','5'=>'5','6'=>'6','7'=>'7'];

	if($item->available_type=='1' || $item->available_type=='2')
	{
		return \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDays($item->available_time))->format('Y-m-d');
	}
	return \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay())->format('Y-m-d');
}


//Supprimer la valeur d'un tableau numerique en gardant l'ordonance de son indexe
function array_middle_shift(&$array,$key) {
    $length=(($key+1)-count($array)==0)?1:($key+1)-count($array);
    return array_splice($array,$key,$length);
}

function get_language_id(){
    return app('language')->language_id;
}

function add_info_cookie_area($zip, $distance){
    $num_of_minutes = 60 * 24 * 7 * 4 * 6; // one week
    Cookie::queue(Cookie::make('zip_code', $zip, $num_of_minutes));
    Cookie::queue(Cookie::make('distance', $distance, $num_of_minutes));
}

function add_area_in_cookie($zip, $distance){
    $num_of_minutes = 60 * 24 * 7 * 4 * 6; // one week
    Cookie::queue(Cookie::make('zip_code', $zip, $num_of_minutes));
    Cookie::queue(Cookie::make('distance', $distance, $num_of_minutes));
}

function count_wishlist(){
    $product_count = 0;
    if(auth()->check()){    
        $products = App\Models\Wishlist::where('user_id',\Auth::user()->user_id)->get();
        $product_count = $products->count();
    }else{
        $wishlists = [];
        if(Cookie::has('id_user_browser')){
            $id_user_browser = Cookie::get('id_user_browser');
            $all_wishlist_product = (\Cache::has('wishlist_product')) ? \Cache::get('wishlist_product') : [];
            if(!empty($all_wishlist_product) && array_key_exists($id_user_browser, $all_wishlist_product)){
                $wishlists = $all_wishlist_product[$id_user_browser];
            }
        }
        $product_count = sizeof($wishlists);
    }
    return $product_count;
}

function all_product_id_wishlist(){
    $id_products = [];
    if(auth()->check()){    
        $products = App\Models\Wishlist::where('user_id',\Auth::user()->user_id)->get();
        foreach ($products as $value) {
        $id_products[] = $value->product_id; 
        }
    }else{
        if(Cookie::has('id_user_browser')){
            $products_user = [];
            $id_user = Cookie::get('id_user_browser');
            $all_wishlist_products = (\Cache::has('wishlist_product')) ? \Cache::get('wishlist_product') : [];
            if (isset($all_wishlist_products[$id_user])) {
                $products_user = $all_wishlist_products[$id_user];
            }
            $id_products = array_keys($products_user);
        }
    }
    return $id_products;
}

function explode_multi($delemiter, $array_string){
    $result_string = [];
    foreach ($array_string as $array) {
        $result_string = array_merge($result_string, explode(',', $array));
    }
    return $result_string;
}

function is_user_has_wishlist(){
    if(Cookie::has('id_user_browser')){
        $id_user = Cookie::get('id_user_browser');
        $all_wishlist_products = (\Cache::has('wishlist_product')) ? \Cache::get('wishlist_product') : [];
        $products_user = $all_wishlist_products[$id_user];
        if(!empty($products_user))
            return true;
        else
            return false;
    }else{
        return false;
    }
}

function average_rating_product($product_id){
    $reviews = App\Models\ProductRating::where('product_id',$product_id)->where('status', 1)->get();
    $total_ratings =  App\Models\ProductRating::where('product_id',$product_id)->where('status', 1)->sum('rating');
    $average_rating = count($reviews) > 0 ? round($total_ratings/count($reviews)): 0;
    return $average_rating;
}

function getDistanceStore($store_lat, $store_lng, $zip_code, $country=''){
    $location = getLatitudeAndLongitudeByZipCode($zip_code, $country);
    if($location != "NOT FOUND"){
        $distance = calculateDistance($store_lat, $store_lng, $location['lat'], $location['lng']);
        return $distance;
    }
    return 0;
}

function getNumberOrderPending($user_id)
{
    $items = \App\Models\OrderItem::whereNotExists(function($query) use ($user_id)
		{
			$query->select('*')
				->from('order_item_request')
				->whereRaw('order_item_request.item_id= order_item.order_item_id')
				->where('order_item_request.merchant_id','=',$user_id);
		})
			->with(['brand','brand.stores', 'product', 'attributes'])
			->where('order_status_id',\App\Models\OrderItem::ORDER_STATUS_ORDERED)
			->get();
	return count($items);		
}
function getNumberOrderEarned($user_id)
{
    $items = \App\Models\OrderItem::whereHas('itemRequest',function($query) use($user_id){
			$query->where('merchant_id',$user_id);
			$query->where('is_added_by','merchant');
		})
			->with(['brand','brand.stores', 'product', 'attributes','itemRequest'=>function($query) use($user_id){
				$query->where('merchant_id',$user_id);
				$query->where('is_added_by',"merchant");
			},'coupon'])
			->where('order_status_id',\App\Models\OrderItem::ORDER_STATUS_REPLIED)
			->get();
	return count($items);		
}
function average_rating($product_id){
    $reviews = \App\Models\ProductRating::where('product_id',$product_id)->where('status', 1)->orderBy('review_date','desc')->paginate(4);
    $total_ratings = \App\Models\ProductRating::where('product_id',$product_id)->where('status', 1)->sum('rating');
    $average_rating = count($reviews) > 0 ? round($total_ratings/count($reviews)): 0;
    return $average_rating;
}
function address($user){
    $user_id = $user->user_id;
    return \App\UserAddress::where('user_id', $user_id)->first();
    
}