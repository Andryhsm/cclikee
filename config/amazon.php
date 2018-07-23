<?php

return [

	/**
	 * Your access key.
	 */
	'access_key' => env('AMAZON_ACCESS_KEY', 'AKIAJE4U44BOPA6PQRSA'),
											
	/**
	 * Your secret key.
	 */
	'secret_key' => env('AMAZON_SECRET_KEY', 'Vc+++GLNseSBCUI80VTEFduqXIYvfRSbAK9SO2kt'),

	/**
	 * Your affiliate associate tag.
	 */
	'associate_tag' => env('AMAZON_ASSOCIATE_TAG', 'alter1-20'),

	/**
	 * Preferred locale
	 */
	'locale' => env('AMAZON_LOCALE', 'ca'),

	/**
	 * Preferred response group
	 */
	'response_group' => env('AMAZON_RESPONSE_GROUP', 'Images,ItemAttributes,Offers,OfferFull'),

	'search_index' => env('AMAZON_SEARCH_INDEX', 'All')


];