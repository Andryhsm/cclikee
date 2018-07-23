<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\OrderStatusRepositoryInterface;
use App\Repositories\OrderStatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class OrderStatusController extends Controller
{
	protected $order_status_repository;

	public function __construct(OrderStatusRepositoryInterface $order_status_repo)
	{
		$this->order_status_repository = $order_status_repo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$status = Datatables::collection($this->order_status_repository->getAll())->make(true);
		$status = $status->getData();
		return view('admin.order_status.list', compact('status'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$status = false;
		return view('admin.order_status.form', compact('status'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$status = $this->order_status_repository->save($request->all());
		flash()->success(config('message.order-status.add-success'));
		return redirect('admin/order-status');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$status = $this->order_status_repository->getById($id);
		return view('admin.order_status.form', compact('status'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$status = $this->order_status_repository->updateById($id, $request->all());
		flash()->success(config('message.order-status.update-success'));
		return redirect('admin/order-status');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if ($this->order_status_repository->deleteById($id)) {
			flash()->success(config('message.order-status.delete-success'));
		} else {
			flash()->error(config('message.order-status.delete-error'));
		}
		return redirect('admin/order-status');
	}
}
