<?php

namespace App\Http\Controllers\Front;

use App\Service\MailchimpService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsletterController extends Controller
{
	protected $mailchimp_service;
    public function __construct(MailchimpService $mail_chimp)
	{
		$this->mailchimp_service = $mail_chimp;
	}

	public function subscribe(Request $request)
	{
		$email_address = $request->get('email');
		$validate      = \Validator::make($request->all(),['email' => 'Required|Email']);
		if (!$validate->fails()) {
			try {
				$this->mailchimp_service->subscribe(['email_address' => $email_address]);
				return \Response::json(["success" => true,
					"message" => ($email_address . ' ajouté avec succès.')]);
			} catch (\Exception $e) {
				return \Response::json(["success" => false,
					"message" => ($e->getMessage())]);
			}
		} else {
			$messages = $validate->errors();
			return \Response::json(["success" => false,
				"message" => ($messages->first())]);
		}
	}
	
	public function unsubscribe(Request $request) 
	{
		$email_address = $request->get('email');
		try {
			$this->mailchimp_service->unsubscribe(['email_address' => $email_address]);
			return \Response::json(["success" => true,
				"message" => ($email_address . ' supprimé avec succès.')]);
		} catch (\Exception $e) {
			return \Response::json(["success" => false,
				"message" => ($e->getMessage())]);
		}
	}
	
	public function getListMembers(){ 
		try {
			$datas = $this->mailchimp_service->getListMembers();
			
			dd($datas);
		
			return $datas;
			/*return \Response::json(["success" => true,
				"message" => ('Campagne OK.')]);*/
		} catch (\Exception $e) {
			return \Response::json(["success" => false,
				"message" => ($e->getMessage())]);
		}
	}
	
	/*public function newCampagne(Request $request) 
	{
		try {
			$this->mailchimp_service->create_send_campagne($request->get('email'));
			return \Response::json(["success" => true,
				"message" => ('Campagne OK.')]);
		} catch (\Exception $e) {
			return \Response::json(["success" => false,
				"message" => ($e->getMessage())]);
		}
	}*/
}
