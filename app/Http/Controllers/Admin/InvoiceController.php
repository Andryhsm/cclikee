<?php

namespace App\Http\Controllers\Admin;

use App\Events\GenerateInvoice;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Interfaces\StoreRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class InvoiceController extends Controller
{
	protected $user_repository;
	protected $order_item_repository;
	protected $invoice_repository;

	public function __construct(UserRepositoryInterface $user_repo, OrderItemRepositoryInterface $order_item_repo, InvoiceRepositoryInterface $invoice_repo)
	{
		$this->user_repository = $user_repo;
		$this->order_item_repository = $order_item_repo;
		$this->invoice_repository = $invoice_repo;
	}

	public function index()
	{
		$invoices = Datatables::collection($this->invoice_repository->getAll())->make(true);
		$invoices = $invoices->getData();
		return view('admin.invoice.list',compact('invoices'));
	}

	public function create()
	{
		$merchants = $this->user_repository->getAllMerchants();
		$items = $this->order_item_repository->getAllInvoiceItems();
		return view('admin.invoice.form',compact('merchants','items'));
	}

	public function store(Request $request)
	{
		$rules = array(
			'merchant_id' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return redirect()->back()->withInput()->withErrors($validator);
		} else {
			$invoice = $this->invoice_repository->save($request->all());

			event(new GenerateInvoice($invoice));

			flash()->success(config('message.invoice.add-success'));
			return Redirect('admin/invoice');
		}
	}

	public function show($id)
	{
		$invoice = $this->invoice_repository->getById($id);
		return view('admin.invoice.show',compact('invoice'));
	}
}
