<?php

namespace App\Models;

use App\Store;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	const COMMISSION_PERCENTAGE=3.9;
	/**
	 * @var string
	 */
	protected $table = 'invoices';
	/**
	 * @var string
	 */
	protected $primaryKey = 'id';

	public function items()
	{
		return $this->hasMany(InvoiceItems::class,'invoice_id','id');
	}

	public function merchant()
	{
		return $this->hasOne(User::class,'user_id','merchant_id');
	}

	public function store()
	{
		return $this->hasOne(Store::class,'store_id','store_id');
	}

}
