<?php

namespace App\Order;


use App\Service\SmsService;
use Twilio;
use App\Events\OrderWasPlaced;

class SMSNotifier
{
	protected $sms_service;

	public function __construct(SmsService $smsService)
	{
		$this->sms_service = $smsService;
	}

	public function handle(OrderWasPlaced $event)
	{
		$to_number = "+".$event->order->customer->phone_number;
		$content_var_values = [];
		$content_var_values['ORDER_ID'] = $event->order->order_id;
		$this->sms_service->send($to_number, config("sms_template.ORDER_CONFIRM"), $content_var_values);
	}
}