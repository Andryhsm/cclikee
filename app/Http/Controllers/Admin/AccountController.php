<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\OrderItemRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
	protected $order_item_repository;

	public function __construct(OrderItemRepositoryInterface $order_item_repo)
	{
		$this->order_item_repository = $order_item_repo;
	}

	public function index()
	{
		$items = $this->order_item_repository->getAllBookedItems();
    	return view('admin.account.list',compact('items'));
	}

	public function show($id)
	{
		$item = $this->order_item_repository->getBookedItemById($id);
		return view('admin.account.show',compact('item'));
	}
}
