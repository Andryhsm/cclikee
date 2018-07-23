<?php

namespace App\Listeners;

use App\Events\CouponWasGenerated;
use App\Events\UserRegistered;
use App\Interfaces\OrderItemCouponInterface;
use App\Interfaces\UserRepositoryInterface;

use App\Service\EmailService;

class CouponNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $email_service;
    protected $user_repository;
    public function __construct(EmailService $email_service,OrderItemCouponInterface $order_item_coupon,UserRepositoryInterface $user_repository)
    {
        //
        $this->email_service=$email_service;
        $this->order_item_coupon=$order_item_coupon;
        $this->user_repository=$user_repository;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(CouponWasGenerated $event)
    {
        $content_var_values = [];
        $user=$this->user_repository->getById($event->order_item_request->customer_id);
        $coupon=$this->order_item_coupon->byOrderItemId($event->order_item_request->item_id)->first();
        $coupon_code=$coupon->coupon_code;
        $content_var_values['NAME'] = $user->first_name." ".$user->last_name;
        $content_var_values['COUPON_CODE'] = $coupon_code;
        $mail_params_array = ['to' => $user->email, 'from' => env('MAIL_FROM_ADDRESS')];
        $this->email_service->sendEmail($mail_params_array, config("email_template.COUPON_NOTIFICATION"), $content_var_values);
    }
}
