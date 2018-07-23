<?php

namespace App\Http\Controllers\Front\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CodePromoRepository;
use App\Repositories\PromotionRepository;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Service\EmailService;
use Mail;
use App\Encasement;
use App\EncasementProduct;
use Illuminate\Support\Facades\Session;

class PromotionController extends Controller
{
    protected $code_promo_repository;
    protected $promotion_repository;
    protected $email_service;

    public function __construct(CodePromoRepository $code_promo_repo,PromotionRepository $promotion_repo,EmailService $email_service)
    {
        $this->promotion_repository = $promotion_repo;
        $this->code_promo_repository = $code_promo_repo;
        $this->email_service = $email_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Datatables::collection($this->promotion_repository->getAll(Session::get('store_to_user')))->make(true);
        $promotions = $promotions->getData();
        return view('merchant.promotion.list', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promotion = false;
        $code_promos = $this->code_promo_repository->getAll(Session::get('store_to_user'));
        return view('merchant.promotion.form', compact('promotion','code_promos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'campagne_name' => 'required',
            'code_promo' => 'required',
            'subject' => 'required',
            'description' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('merchant/promotion/create')->withInput()->withErrors($validator);
        } else {
            $promotion = $this->promotion_repository->save($request->all());
            if($promotion){
                /*try {
                    Mail::send('front.email.sample', ['email_content' => 'test'], function ($message){
                        $message->to('aa@alternateeve.com')->subject('ptit');
                    });
                } catch (\Exception $e) {
                    return $e->getMessage();
                }*/

                flash()->success(config('message.promotion.add-success'));
                return Redirect('merchant/promotion');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promotion = $this->promotion_repository->getById($id);
        $code_promo = $this->code_promo_repository->getById($promotion->code_promo_id);
        $encasementproducts = EncasementProduct::where('promo_code_id',$code_promo->code_promo_id)->orderBy('encasement_product_id', 'desc')->get();
        return view('merchant.promotion.results',compact('encasementproducts','code_promo','promotion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
