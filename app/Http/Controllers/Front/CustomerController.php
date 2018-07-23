<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\StoreRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\FaqRepositoryInterface;
use App\Models\OrderItem;
use App\User;
use App\UserAddress;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Input;
use PDF;
use App\Models\OrderItemRequest;

class CustomerController extends Controller
{

    protected $user_repository;
    protected $store_repository;
	protected $order_item_repository;
	protected $faq_repository;

    public function __construct(UserRepositoryInterface $user_repository,FaqRepositoryInterface $faq_repository, OrderRepositoryInterface $order_repository, StoreRepositoryInterface $store_repository, OrderItemRepositoryInterface $order_item_repo)
    {
        $this->user_repository = $user_repository;
        $this->order_repository = $order_repository;
        $this->store_repository = $store_repository;
		$this->order_item_repository = $order_item_repo;
		$this->faq_repository = $faq_repository;
    }
    public function index(){
        $user_id = Auth::id();
        $customer = $this->user_repository->getById($user_id);
        return view('front.customer.index',compact('customer'));
    }

    public function completedOrders()
    {
        $user_id = Auth::id();
        $completed_orders = $this->order_repository->completedOrders($user_id);
        return view('front.customer.orders.completed',compact('completed_orders'));
    }

    public function onGoingOrders()
    {
        $user_id = Auth::id();
        $pending_orders = $this->order_repository->onGoingOrders($user_id);
        return view('front.customer.orders.pending',compact('pending_orders'));
    }

    public function postManageAccount(Request $request)
    {
        $user = Auth::user();
        $user->first_name=\Input::get('first_name');
        $user->last_name=\Input::get('last_name');
        $user->email=\Input::get('email');
		$user->phone_number = Input::get('phone');
		$user->radius = Input::get('radius');
        if ($user->save(User::$manage_account_rules)) {
        	if(Input::has('zip')){
				$user_address = ($user->address != null && count($user->address) > 0) ?  $user->address : new UserAddress();
				$user_address->first_name = Input::get('first_name');
				$user_address->last_name = Input::get('last_name');
				$user_address->phone = Input::get('phone');
				$user_address->zip = Input::get('zip');
				$user->address()->save($user_address);
				add_area_in_cookie(Input::get('zip'), Input::get('radius'));
			}
            \Session::flash('message.success', 'Account updated successfully.');
            return \Redirect::to("customer");
        } else {
            \Session::flash('message.arrayErrors', $user->errors()->all());
            return \Redirect::to('customer')->withInput($request->all());
        }
    }

    public function postResetPassword()
    {
        $user = Auth::user();
        $user->password=Hash::make(Input::get('password'));
        $user->save();
        \Session::flash('message.success', 'Password updated successfully.');
        flash()->success('Password updated successfully.');
        return \Redirect::to("customer");
    }

    public function getPendingOrders()
    {
        $users = User::find(Auth::id())->store()->get();
        $brands_id = [];
        foreach ($users->first()->brands as $brand) {
            if (!empty($brand->products)) {
                $brands_id[] = $brand->brand_id;
            }
        }
        $pending_orders = $this->order_repository->getOrders($brands_id);
        return view('front.customer.orders.pending', compact('pending_orders'));
    }

    public function getCurrentOrder(){
        $user = \Auth::user();
        $user_id = $user->user_id;
        $pending_items = $this->order_item_repository->itemByStatusAndUser([OrderItem::ORDER_STATUS_REPLIED,OrderItem::ORDER_STATUS_ORDERED,OrderItem::ORDER_STATUS_NEGATIVE],$user_id);
        return view('front.customer.current_order.index', compact('pending_items'));
    }
    
    public function waitingOrder($id){
        $item_request = OrderItemRequest::find($id);
		$item_request->available_type = 2;
		$item_request->save();
		$this->order_item_repository->updateStatus(OrderItem::ORDER_STATUS_REPLIED, $item_request->item_id);
        return response()->json(['success'=> true,'message' => 'Commande mise en attente éffectué avec succèes']);
    }
    
    public function canceledOrder($id){
        $item_request = OrderItemRequest::find($id);
		$item_request->is_canceled = 1;
		$item_request->booked_date = Carbon::now();
		$item_request->available_type = 6;
		$item_request->save();
		$this->order_item_repository->updateStatus(OrderItem::ORDER_STATUS_CANCELED, $item_request->item_id);
        return response()->json(['success'=> true,'message' => 'Commande annulée avec succèes' ]);
    }
    
    public function getCustomerBills(){
        return view('front.customer.customer_bills.index');
    }
    
    public function getCurrentCoupon($id){
        $item = $this->order_item_repository->getItemById($id);
        return view('front.customer.current_order.coupon', compact('item'));
    }
    
    public function getOrderStory(){
        $items = $this->order_item_repository->getBookedItemByUser(\Auth::user()->user_id);
        return view('front.customer.order_story.index', compact('items'));
    }
    
    public function getCustomerInformations(){
        $user_id = Auth::id();
        $customer = $this->user_repository->getById($user_id);
        return view('front.customer.customer_informations.index', compact('customer'));
    }
    
    public function updateCustomerInformations(Request $request){
        $user = Auth::user();
        $birthday = Carbon::parse(Input::get('birthday'));
        try{
            $user->gender= Input::get('gender');
            $user->first_name= Input::get('first_name');
            $user->last_name= Input::get('last_name');
            $user->email= Input::get('email');
            $user->phone_number = Input::get('phone');
            $user->birthday = $birthday;
            if($user->save()){
                $user_address = ($user->address != null && count($user->address) > 0) ?  $user->address : new UserAddress();
                $user_address->first_name = Input::get('first_name');
                $user_address->last_name = Input::get('last_name');
                $user_address->phone = Input::get('phone');
                $user_address->zip = Input::get('zip');
                $user_address->city = Input::get('city');
                $user->address()->save($user_address);
                return response()->json(['success'=> true,'message' => 'Informations modifiés avec succès.']);
            }
            
        }
        catch (Exception $e) {
            return response()->json(['success'=> false,'message' => $e]);
            //dd($e->getMessage());
        }
        
    }
    
    public function getDistanceStore(Request $request){

        $store_lat = \Input::get('latitude');
        $store_lng = \Input::get('longitude');
        $store_country = \Input::get('country');
        $zip_code = auth()->user()->address->zip;
        $distance = getDistanceStore($store_lat, $store_lng, $zip_code, $store_country);
        return response()->json(['distance' => $distance]);
        
    }
    
    public function getNewsLetter(){
        return view('front.customer.newsletters.index');
    }
    
    public function getChangePassword(){
        return view('front.customer.change_password.index');
    }
    
    public function updatePassword(Request $request){
        
        $oldPass = $request['old_password'];
        $newPass = Hash::make($request['new_password']);
        
        $hashedPassword = auth()->user()->password;

        if(Hash::check($oldPass, $hashedPassword)) {
            $user = Auth::user();
            $user->password=$newPass;
            $user->save();
        	return response()->json(['success'=> true,'message' => 'Mot de passe modifié avec succès']);
        }else{
            return response()->json(['success'=> false,'message' => 'Vérifier votre ancien mot de passe']);
        }	
    }
     public function getFaq(){
        $faqs = $this->faq_repository->getByType(1);
        return view('front.customer.aid_faq.index',compact('faqs'));
    }
    
    public function downloadPdf($id){
        $item = $this->order_item_repository->getItemById($id);
        $pdf = PDF::loadView('front.customer.current_order.couponfile',compact('item'));
        return $pdf->download('coupon_'.Auth::user()->first_name.'_'.Auth::user()->last_name.'_'.$item->order->order_id.'.pdf');
    }
    
    public function printPdf($id){
        $item = $this->order_item_repository->getItemById($id);
        $pdf = PDF::loadView('front.customer.current_order.couponfile',compact('item'));
        return $pdf->stream();
    }
}