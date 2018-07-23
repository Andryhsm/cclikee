<?php

namespace App\Service;


use App\Interfaces\NewsletterSubscriptionInterface;
use ZfrMailChimp\Client\MailChimpClient;

class MailchimpService implements NewsletterSubscriptionInterface
{
	protected $client = '';
	protected $mailchimp_key = '';
	protected $mailchimp_list_id = '';

	public function __construct()
	{
		$this->mailchimp_key = config('services.mailchimp.MAILCHIMP_API_KEY');
		$this->mailchimp_list_id = config('services.mailchimp.MAILCHIMP_LIST_ID');
		$this->client = new MailChimpClient(config('services.mailchimp.MAILCHIMP_API_KEY'));
	}

	public function subscribe($subscriptionInfo = [])
	{
		return $this->client->subscribe(['id' => $this->mailchimp_list_id,
			'email' => ['email' => $subscriptionInfo['email_address'],]]);
	}

	public function unSubscribe($subscriptionInfo = [])
	{
		return $this->client->unsubscribe(['id' => $this->mailchimp_list_id,
			'email' => ['email' => $subscriptionInfo['email_address'],]]);
	}

	public function getUserStatus($email = '')
	{
		return $this->client->getListMembersInfo(['id' => $this->mailchimp_list_id,
			'emails' => [['email' => $email]]
		]);
	}
	
	public function getListMembers()
	{
		return $this->client->getListMembers(['id' => $this->mailchimp_list_id]);
	}
	
	/*public function create_send_campagne($test){

	        $options = [
	        'id'   => $this->mailchimp_list_id,
	        'subject' => 'test',
	        'from_name' => 'Andry',
	        'from_email' => 'aa@alternateeve.com',
	        'to_name' => 'andryhsm@gmail.com'
	        ];


	        $content = [
	        'html' => 'test test test',
	        'text' => strip_tags('test test test')
	        ];


	        $campaign = $this->client->createCampaign('regular', $options, $content);
	        return $this->client->sendCampaign($campaign['id']);

	}*/
}