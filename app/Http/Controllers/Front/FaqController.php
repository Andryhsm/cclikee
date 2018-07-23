<?php

namespace App\Http\Controllers\Front;

use App\Interfaces\FaqRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
	protected $faq_repository;

	public function __construct(FaqRepositoryInterface $faqRepository)
	{
		$this->faq_repository = $faqRepository;
	}

	public function index()
	{
		$faqs = $this->faq_repository->getByType(1);
		return view('front.faq',compact('faqs'));
	}
	public function businessFaq()
	{
		$faqs = $this->faq_repository->getByType(2);
		return view('front.faq',compact('faqs'));
	}
}
