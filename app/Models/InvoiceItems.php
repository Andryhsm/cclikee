<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItems extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'invoice_items';
	/**
	 * @var string
	 */
	protected $primaryKey = 'id';

	//

	public function invoice()
	{
		return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
	}

	public function orderItem()
	{
		return $this->hasOne(OrderItem::class,'order_item_id','order_item_id');
	}
}
