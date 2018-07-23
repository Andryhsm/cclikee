<?php

namespace App\Http\Controllers\Front\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CodePromoRepository;
use App\Interfaces\CategoryRepositoryInterface;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CodePromoController extends Controller
{
    protected $code_promo_repository;
    protected $category_repository;

    public function __construct(CodePromoRepository $code_promo_repo, CategoryRepositoryInterface $category_repo)
    {
        $this->code_promo_repository = $code_promo_repo;
        $this->category_repository = $category_repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $code_promos = Datatables::collection($this->code_promo_repository->getAll(auth()->user()->store->first()->store_id))->make(true);
        $code_promos = $code_promos->getData();
        return view('merchant.code_promo.list', compact('code_promos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language_id=app('language')->language_id;
        $categories = $this->category_repository->getParentCategories($language_id);
        $code_promo = false;
        return view('merchant.code_promo.form', compact('code_promo','categories'));
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
            'code_promo_name' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
            'quantity_max' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $code_promo=$this->code_promo_repository->save($request->all());
            if($code_promo){
                flash()->success(config('message.code_promo.add-success'));
                return redirect()->route('code-promo.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language_id=app('language')->language_id;
        $code_promo = $this->code_promo_repository->getById($id);
        $categories = $this->category_repository->getParentCategories($language_id);
        return view('merchant.code_promo.form', compact('code_promo','categories'));
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
        $rules = array(
            'code_promo_name' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
            'quantity_max' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $code_promo=$this->code_promo_repository->updateById($id,$request->all());
            if($code_promo){
                flash()->success(config('message.code_promo.update-success'));
                return redirect()->route('code-promo.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->code_promo_repository->deleteById($id)) {
            flash()->success(config('message.code_promo.delete-success'));
        }else {
            flash()->error(config('message.code_promo.delete-error'));
        }
        return redirect()->route('code-promo.index');
    }
    
    public function getProduct(Request $request){
        $keyword = $request->get('datastring');
        $products = $this->code_promo_repository->getProducts($keyword,\Auth::user()->user_id);
        return response()->json($products);
    }
}
