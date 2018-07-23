<?php
namespace App\Invoice;

use App\Events\GenerateInvoice;
use App\Models\Invoice;
use App\Models\InvoiceItems;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class InvoiceGenerator
{
	protected $stripe_key;

	public function __construct()
	{
		$this->stripe_key = config('services.stripe.secret');
	}

	public function handle(GenerateInvoice  $event)
	{
		$invoice = $event->invoice;
		$stripe = Stripe::make($this->stripe_key);

		foreach ($invoice->items as $item)
		{
			$invoiceItem = $stripe->invoiceItems()->create($invoice->merchant->stripe_id, [
				'amount'   => $item->commission,
				'currency' => 'USD',
			]);

			InvoiceItems::where('id',$item->id)->update(['stripe_id'=>$invoiceItem['id']]);
		}
		$response = $stripe->invoices()->create($invoice->merchant->stripe_id,['description'=>$invoice->notes]);
		Invoice::where('id',$invoice->id)->update(['stripe_id'=>$response['id']]);
	}

}