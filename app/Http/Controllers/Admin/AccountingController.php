<?php

namespace App\Http\Controllers\Admin;
use App\Interfaces\OrderItemRequestInterface;
use App\Interfaces\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Redirect;
use App\Interfaces\StoreRepositoryInterface;
use App\EncasementOrderLastReset;

class AccountingController extends Controller
{
    protected $order_item_repository;
    protected $customer_repository;
	protected $store_repository;
	protected $model;
    
    public function __construct(EncasementOrderLastReset $model,StoreRepositoryInterface $store_repo,OrderItemRequestInterface $order_item_repo, CustomerRepositoryInterface $customer_repo){
        $this->order_item_request = $order_item_repo;
        $this->store_repository = $store_repo;
        $this->customer_repository = $customer_repo;
        $this->model = $model;
    }
    
    public function index()
    {
        $stores = Datatables::collection($this->store_repository->getAll())->make(true);
		$stores = $stores->getData();
        return view('admin.accounting.table', compact('stores'));
    }

 
    public function reset($id)
    {
        $response1 = $this->order_item_request->resetOrderItemAccounting($id);
        $response2 = $this->order_item_request->resetEncasementAccounting($id);
        
        $lastreset = $this->model->firstOrNew(['store_id' => $id]); 
        $lastreset->total_price = 0;
        $lastreset->store_id = $id;
        $lastreset->save();
        
        return Redirect::to('admin/accounting');
    }


    public function store(Request $request)
    {
        //
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
