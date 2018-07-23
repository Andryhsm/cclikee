<?php

namespace App\Providers;

use App\Cart\Listeners\CartEventHandler;
use App\Events\CouponWasGenerated;
use App\Events\GenerateInvoice;
use App\Events\ItemRequest;
use App\Events\ItemRequets;
use App\Events\OrderSave;
use App\Events\OrderWasPlaced;
use App\Events\UserRegistered;
use App\Invoice\InvoiceGenerator;
use App\Listeners\CouponNotification;
use App\Listeners\EmailNotificationToMerchant;
use App\Listeners\EmailNotifier;
use App\Listeners\ItemRequestNotifier;
use App\Listeners\SignupSmsNotifier;
use App\Listeners\UserEventHandler;
use App\Models\OrderItemRequest;
use App\Order\SMSNotifier;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
	protected $subscribe = [
//		UserEventHandler::class,
		CartEventHandler::class
	];

	protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
		OrderWasPlaced::class=>[
			\App\Order\EmailNotifier::class,
			SMSNotifier::class
		],
        UserRegistered::class =>[
//            EmailNotifier::class,
//			SignupSmsNotifier::class
        ],
        ItemRequest::class=>[
           //ItemRequestNotifier::class
        ],
        CouponWasGenerated::class=>[
           //CouponNotification::class
        ],
        OrderSave::class=>[
            //EmailNotificationToMerchant::class

        ],
		GenerateInvoice::class=>[
			InvoiceGenerator::class
		],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
