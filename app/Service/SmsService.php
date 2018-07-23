<?php

namespace App\Service;

use App\Models\EmailTemplate;
use App\Models\EmailTemplateVariable;
use Twilio;

class SmsService
{

	public function __construct()
	{

	}

	public function send($to_number, $template, $dynamic_data)
	{
		$template_variables = EmailTemplateVariable::whereHas('emailTemplate', function ($query) use ($template) {
			$query->whereTemplateName($template);
			$query->where('template_type', '2');
		})->get();

		$replace_array = $key_array = [];
		foreach ($template_variables as $template_variable) {
			$key_array[] = $template_variable->variable_name;
			$replace_array[] = (isset($dynamic_data[trim($template_variable->variable_name, '#')])) ? $dynamic_data[trim($template_variable->variable_name, '#')] : '';
		}
		// Email Template content get and replace variable with user value
		$sms_data = EmailTemplate::whereTemplateName($template)->first();
		if (empty($sms_data)) {
			return;
		}
		$content = str_replace($key_array, $replace_array, $sms_data->english->sms_content);
		try {
			$response = Twilio::message($to_number, $content);
			return $response;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

}