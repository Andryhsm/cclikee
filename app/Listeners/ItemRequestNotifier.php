<?php

namespace App\Listeners;

use App\Events\ItemRequest;
use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Service\EmailService;

class ItemRequestNotifier
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
    public function handle(ItemRequest $event)
    {
        $content_var_values = [];
        $content_var_values['NAME'] = $event->user->first_name." ".$event->user->last_name;
        $mail_params_array = ['to' => $event->user->email, 'from' => env('MAIL_FROM_ADDRESS')];
        $email_template_name=($event->user->role_id==1)?'CUSTOMER_NOTIFICATION':'MERCHANT_NOTIFICATION';
        //dd($email_template_name);
        $send_email = $this->email_service->sendEmail($mail_params_array, config("email_template.".$email_template_name), $content_var_values);
    }
}
