<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\OrderStatusRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
	protected $order_status_repository;
	protected $order_repository;
	public function __construct(OrderStatusRepositoryInterface $order_status_repo,OrderRepositoryInterface $order_repo)
	{
		$this->order_status_repository = $order_status_repo;
		$this->order_repository = $order_repo;
	}

	public function index($status)
	{
		$title = [
			'1' => 'Ventes en cours',
			'2' => 'Ventes terminées',
			'3' => 'Demande spéciale'
		];
		return view('admin.sales.list', ['title' => $title[$status],'status'=>$status]);
	}


	public function getData($status)
	{
		$data_tables = \Datatables::collection($this->order_repository->getByStatus($status));

		$data_tables->EditColumn('order_id', function ($order) {
			return  $order->order_id;
		})->EditColumn('order_date', function ($order) {
			return convertDate($order->order_date);
		})->EditColumn('customer', function ($order) {
			return $order->customer->first_name." ".$order->customer->last_name;
		})->EditColumn('order_total', function ($order) {
			return format_price($order->total);
		})->editColumn('products_name', function ($order) {
			$product_name = '';
			foreach ($order->orderItems as $item) {
				$product_name.='<span class="badge bg-green">' . $item->product_name . '</span>';
			}
			return $product_name;
		})->EditColumn('action', function ($order) {
			return view("admin.sales.action", ['order' => $order]);
		});
		return $data_tables->rawColumns(['products_name','action'])->make(true);
	}

	public function view($order_id)
	{
        $order=Order::where('order_id',$order_id)->with('customer','orderItems','billingAddress','transaction')->get()->first();
		$order_status = $this->order_status_repository->getAll();
		return view('admin.sales.view')->with('order',$order)->with('order_status',$order_status);
	}

	public function productBilled()
	{
		  $order_items=OrderItem::with(['order','order.customer','order.status','product','itemRequest'=>function($query){
			  $query->where('is_added_by',"customer");
		  }])->get();
		  return view('admin.sales.product_billed',compact('order_items'));
	}

	public function byItemId($item_id)
	{

		$order_item=orderItem::where('order_item_id',$item_id)->with(['order','order.customer','order.customer.address','product','order.transaction','itemRequest'=>function($query){
			$query->where('is_added_by',"customer");
		}])->get()->first();
		
		return view('admin.sales.item_detail',compact('order_item'));
	}

	public function onGoing()
	{

	}

	public function completed()
	{

	}

	public function special()
	{

	}

	public function destroy($order_id)
	{
		$order = Order::find($order_id);
		$order->orderItems()->delete();
		$order->billingAddress()->delete();
		$order->transaction()->delete();
		$order->delete();
		flash()->success(config('message.order.delete-success'));
		return redirect()->back();
	}
	public function updateStatus($order_id, Request $request)
	{
		$order_status_id = $request->get('order_status');
		$this->order_repository->updateStatusById($order_id,$order_status_id);
		flash()->success(config('message.order.update-success'));
		return redirect()->back();
	}
}
