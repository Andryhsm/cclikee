<?php
namespace App\Service;
use App\Models\EmailTemplate;
use App\Models\EmailTemplateVariable;
use Mail;
Class EmailService {

    public function __construct(){

    }

	public function sendEmail($mail_params_array, $template, $dynamic_data)
	{
		$to = $mail_params_array['to'];
		$from = isset($mail_params_array['from']) ? $mail_params_array['from'] : env('MAIL_FROM_ADDRESS');
		$from_name = isset($mail_params_array['from_name']) ? $mail_params_array['from_name'] : env('MAIL_FROM_NAME');
		$attachments = isset($mail_params_array['attachments']) ? $mail_params_array['attachments'] : [];
		$headers = isset($mail_params_array['headers']) ? $mail_params_array['headers'] : [];
		$template_variables = EmailTemplateVariable::whereHas('emailTemplate', function ($query) use ($template) {
			return $query->whereTemplateName($template);
		})->get();

		$replace_array = $key_array = [];
		foreach ($template_variables as $template_variable) {
			$key_array[] = $template_variable->variable_name;
			$replace_array[] = (isset($dynamic_data[trim($template_variable->variable_name, '#')])) ? $dynamic_data[trim($template_variable->variable_name, '#')] : '';
		}
		// Email Template content get and replace variable with user value
		$email_data = EmailTemplate::whereTemplateName($template)->first();
		$subject = isset($mail_params_array['subject']) ? $mail_params_array['subject'] : $email_data->english->subject;
		$content = str_replace($key_array, $replace_array, $email_data->english->content);
		$content_data = ['email_content' => $content];
		/* Sending Email mechanism after successful  */
		try {
			Mail::send('front.email.sample', $content_data, function ($message) use ($to, $from, $from_name, $subject, $attachments) {
				$message->from($from, $from_name)
					->to($to)
					->subject($subject);
				// file attachment
				if (isset($attachments) && !empty($attachments)) {
					foreach ($attachments as $att_file) {
						$message->attach($att_file);
					}
				}
				if (isset($headers) && !empty($headers)) {
					$headers = $message->getHeaders();
					foreach ($headers as $key => $val) {
						$headers->addTextHeader($key, $val);
					}
				}
				$headers = $message->getHeaders();
				$headers->addTextHeader('X-MC-PreserveRecipients', 'false');
			});
		} catch (\Exception $e) {
			return $e->getMessage();
		}
		return Mail::failures();
	}
}