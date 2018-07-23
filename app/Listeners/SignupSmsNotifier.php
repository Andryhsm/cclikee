<?php

namespace App\Listeners;


use App\Events\UserRegistered;
use App\Service\SmsService;

class SignupSmsNotifier
{
	protected $sms_service;

	public function __construct(SmsService $smsService)
	{
		$this->sms_service = $smsService;
	}

	public function handle(UserRegistered $event)
	{
		$to_number = "+".$event->user->phone_number;
		$content_var_values = [];
		$content_var_values['EMAIL_ADDRESS'] = $event->user->email;
		$this->sms_service->send($to_number, config("sms_template.SIGN_UP"), $content_var_values);
	}
}