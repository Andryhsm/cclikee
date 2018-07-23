<?php

namespace App\Interfaces;


interface NewsletterSubscriptionInterface
{

	public function subscribe($subscriptionInfo = []);

	public function unSubscribe($subscriptionInfo = []);

	public function getUserStatus($email = '');

}