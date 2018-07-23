<?php
namespace App\Order;

use App\Models\OrderTransaction;
use ShoppingCart\Cart;
use Event;
use App;
use App\Interfaces\OrderRepositoryInterface;
use App\Events\OrderWasPlaced;
use Request;
use DB;
use Auth;

class Processor
{
    /** @var OrderRepositoryInterface $order_repository */
    protected $order_repository;
    /** @var OrderValidatorInterface[] $order_validators */
    protected $order_validators;

    public function __construct(
        OrderRepositoryInterface $order_repository
    ) {
        $this->order_repository = $order_repository;
		$this->order_validators = [];
    }

    public function placeOrder(Cart $cart, $data)
    {
        try {
//            DB::beginTransaction();
            foreach ($this->order_validators as $order_validator) {
                $order_validator->validate($cart);
            }

			$cart->setPaymentType(isset($data['payment_type'])?$data['payment_type']:0);
            $order = $this->order_repository->saveOrder($cart);
			try {
				Event::fire(new OrderWasPlaced($order));
			} catch (\Exception $e) {
				\Log::critical("Order post processing failed for ID: " . $order->order_id . " with message: " . $e->getMessage(),$e->getTrace());
			}
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
