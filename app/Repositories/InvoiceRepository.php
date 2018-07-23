<?php

namespace App\Repositories;


use App\Interfaces\InvoiceRepositoryInterface;
use App\Models\Invoice;
use App\Models\InvoiceItems;

class InvoiceRepository implements InvoiceRepositoryInterface
{
	protected $model;
	public function __construct(Invoice $invoice)
	{
		$this->model = $invoice;
	}
	public function save($input)
	{
		$this->model->merchant_id = $input['merchant_id'];
		$this->model->store_id = $input['store_id'];
		$this->model->amount = $input['invoice_total'];
		$this->model->created_by = auth()->guard('admin')->user()->admin_id;
		$this->model->status = '0';
		$this->model->notes = $input['invoice_notes'];
		$this->model->save();

		if(!empty($input['item_ids'])){
			foreach ($input['item_ids'] as $index=>$item)
			{
				$invoice_item = new InvoiceItems();
				$invoice_item->order_item_id = $item;
				$invoice_item->price = !empty($input['item_price'][$index]) ? $input['item_price'][$index] : 0;
				$invoice_item->commission = !empty($input['item_commission'][$index]) ? $input['item_commission'][$index] : 0;
				$this->model->items()->save($invoice_item);
			}
		}
		return $this->model;

	}

	public function getAll()
	{
		return $this->model->with('items','merchant','store')->get();
	}

	public function getById($id)
	{
		return $this->model->with('merchant','store','store.state','store.country','items','items.orderItem','items.orderItem.product')->where('id',$id)->first();
	}
	public function getAllByPaginate()
	{
		return $this->model->with('items')->paginate(4);
	}
}