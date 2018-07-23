<?php

namespace App\Events;
use App\Models\OrderItemRequest;
use Illuminate\Queue\SerializesModels;
class CouponWasGenerated extends Event
{
    use SerializesModels;
    public $order_item_request;
    /**
     * Create a new event instance.
     *
     * @param  Customer $customer
     * @param  $password_needs_to_set
     */
    public function __construct(OrderItemRequest $order_item_request)
    {
        $this->order_item_request=$order_item_request;
    }
}
