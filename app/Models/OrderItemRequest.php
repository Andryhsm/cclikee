<?php
namespace App\Models;
use App\Store;
use App\User;
use Illuminate\Database\Eloquent\Model;

class OrderItemRequest extends Model
{

    protected $table = 'order_item_request';
    protected $primaryKey = 'order_item_request_id';
    public $timestamps = false;
	const AVAILABLE_TYPE = ['1'=>'available_now','2'=>'available_in','3'=>'not_available','4'=>'price_problem','5'=>'replacement_product'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'customer_id',
        'store_id',
        'merchant_id',
        'message',
        'is_added_by',
        'created_date',
        'reset_accounting'
    ];

    public function orderitem(){
        return $this->belongsTo(OrderItem::class,'item_id','order_item_id');
    }
    public function user()
	{
        return $this->belongsTo(User::class,'customer_id','user_id');
    }
    public function merchant()
	{
		return $this->belongsTo(User::class,'merchant_id','user_id');
	}

    public function parent()
	{
        return $this->hasOne(OrderItemRequest::class, 'parent_id','order_item_request_id');
    }

    public function store()
	{
		return $this->hasOne(Store::class,'store_id','store_id');
	}
}
