<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    /*'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],*/
    'twitter' => [
        'client_id'     => env('TWITTER_ID','nMF6CrRFecJjbXklkIsKm4Xdv  '),
        'client_secret' => env('TWITTER_SECRET','JFgCxlGohhx11vvuBzSIH1Lalte6csxjZLGBcpnYhVWrQdZ6ED'),
        'redirect'      => env('TWITTER_URL','https://www.alternateeve.com/auth/twitter/callback'),
        'scope'         =>'email'
    ],
    'facebook' => [
        'client_id'     => env('FACEBOOK_ID', '454775958253469'),
        'client_secret' => env('FACEBOOK_SECRET', '89377702b8a56fc6acec6772e2d13a4a'),
        'redirect'      => env('FACEBOOK_URL','https://www.alternateeve.com/auth/facebook/callback')
    ],
    'google' => [
        'client_id' => '522242092653-8o7qpi17q3cko0ndmlgip2sp9vs5ugtq.apps.googleusercontent.com',
        'client_secret' => 'llDbISXQuOi_ZV_TZx1mZd2h',
        'redirect' => 'http://www.alternateeve.com/auth/google/callback'
    ],
	'stripe' => [
	    'model' => App\User::class,
		'secret' => 'sk_test_5CbhD8NXUtPa5JJS82pOuSRe',
		'publishable_key'=>'pk_test_6cdssMcfB8ANMpuYrunjIdda'
	],
	'mailchimp' => [
		'MAILCHIMP_API_KEY' => '09d28a3824eb4ce1bbb69362b4ea77c2-us18',
		'MAILCHIMP_LIST_ID' => 'e0da043836'
	],
	'sendinblue' => [
       'url' => 'https://api.sendinblue.com/v2.0',
       'key' => env('SENDINBLUE_KEY'),
    ],


];
