<?php

namespace App\Order;

use App\Service\EmailService;
use App\Events\OrderWasPlaced;

class EmailNotifier
{
	protected $email_service;

	public function __construct(EmailService $emailService)
	{
		$this->email_service = 	$emailService;
	}

	public function handle(OrderWasPlaced $event)
	{
		$content_var_values = [];
		$content_var_values['NAME'] = $event->order->user->first_name." ".$event->order->user->last_name;
		$mail_params_array = ['to' => $event->order->user->email, 'from' => env('MAIL_FROM_ADDRESS')];
		$send_email = $this->email_service->sendEmail($mail_params_array, config("email_template.SIGN_UP"), $content_var_values);
	}

}