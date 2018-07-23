<?php

namespace App\Repositories;


use App\Interfaces\OrderStatusRepositoryInterface;
use App\OrderStatus;

class OrderStatusRepository implements OrderStatusRepositoryInterface
{
	protected $model;

	public function __construct(OrderStatus $order_status)
	{
		$this->model = $order_status;
	}

	public function getAll()
	{
		return $this->model->orderBy('order_status_id', 'desc')->get();
	}

	public function getById($status_id)
	{
		return $this->model->where('order_status_id', $status_id)->first();
	}

	public function save($input)
	{
		$this->model->status_name = $input['status_name'];
		$this->model->customer_status = $input['customer_status'];
		$this->model->sort_order = 0;
		$this->model->is_default = isset($input['is_default']) ? $input['is_default'] : 0;
		$this->model->created_by = auth()->guard('admin')->user()->admin_id;
		$this->model->save();
		return $this->model;
	}

	public function updateById($status_id, $input)
	{
		$order_status = $this->model->findOrNew($status_id);
		$order_status->status_name = $input['status_name'];
		$order_status->customer_status = $input['customer_status'];
		$order_status->sort_order = 0;
		$order_status->is_default = isset($input['is_default']) ? $input['is_default'] : 0;
		$order_status->save();
		return $order_status;

	}

	public function deleteById($status_id)
	{
		return $this->model->where('order_status_id', $status_id)
			->delete();
	}
}