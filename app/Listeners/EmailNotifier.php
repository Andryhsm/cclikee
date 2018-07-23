<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Service\EmailService;

class EmailNotifier
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $email_service;
    public function __construct(EmailService $email_service)
    {
        //
        $this->email_service=$email_service;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
		$content_var_values = [];
		$content_var_values['NAME'] = $event->user->first_name." ".$event->user->last_name;
		$mail_params_array = ['to' => $event->user->email, 'from' => env('MAIL_FROM_ADDRESS')];
		$send_email = $this->email_service->sendEmail($mail_params_array, config("email_template.SIGN_UP"), $content_var_values);
    }
}
