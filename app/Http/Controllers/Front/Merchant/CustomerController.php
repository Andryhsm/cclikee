<?php

namespace App\Http\Controllers\Front\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use PDF;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $customer_repository;
    protected $product_repository;

    public function __construct(CustomerRepositoryInterface $customer_rep_interface, ProductRepositoryInterface $product_repos){
        $this->customer_repository = $customer_rep_interface;
        $this->product_repository = $product_repos;
    }

    public function index()
    {
        $customers_user = $this->customer_repository->getCustomers(Session::get('store_to_user'));
        $customers_local = $this->customer_repository->getCustomersLocal(Session::get('store_to_user'));
        //dd($customers_local);
        return view('merchant.customer.index')->with('customers_user', $customers_user)->with('customers_local', $customers_local);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = [];
        $product_is_active = $this->product_repository->getAll();
        return view('merchant.customer.form', compact('customer','product_is_active'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required'
        );
        $validator = \Validator::make($request->all(), $rules);   
        if($validator->fails()){   
            return Redirect::back()->withInput()->withErrors($validator);   
        }else{
            $customer = $this->customer_repository->save($request->all());
            flash()->success(config('message.customer.add-success'));
        }
        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $type_customer = Input::get('type_customer');
        if($type_customer == \App\StoreCustomer::CUSTOMER_SYSTEM_USER){
            $customer = $this->customer_repository->getCustomerSystemById($id);
        }else{
            $customer = $this->customer_repository->getCustomerLocalById($id);
        }

        $products = $this->product_repository->getAll();
        return view('merchant.customer.form')->with('customer', $customer)->with('product_is_active', $products)->with('type_customer', $type_customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $store_id, $user_id)
    // {
    //     $rules = array(
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'email' => 'required'
    //     );
    //     $validator = \Validator::make($request->all(), $rules);   
    //     if($validator->fails()){   
    //         return Redirect::back()->withInput()->withErrors($validator);   
    //     }else{
    //         $customer = $this->customer_repository->update($id, $request->all());
    //         flash()->success(config('message.customer.update-success'));
    //     }
    //     return \Redirect('merchant/customer');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = $this->customer_repository->deleteById($id);
        flash()->success(config('message.customer.delete-success'));
        return redirect()->route('client.index');
    }

    public function encasement()
    {
        return view('merchant.customer.encasement');
    }

    public function addContact()
    {
        return view('merchant.promotion.add_contact');
    }

    public function saveContactCustomer(Request $request)
    {
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required'
        );
        $validator = \Validator::make($request->all(), $rules);   
        if($validator->fails()){   
            return Redirect::back()->withInput()->withErrors($validator);   
        }else{
            $customer = $this->customer_repository->saveContactCustomer($request->all());
            flash()->success("Enregistrement avec succèss !");
        }
        return redirect()->route('promotion.index');
    }
    
    public function getAllCustomer(Request $request)
    {
        $users = $this->customer_repository->getAllCustomersSystem();
        return response()->json([$users]);
    }
    
    public function facture()
    {
        return view('merchant.customer.facture');
    }
    
    public function facturePdf()
    {
        $pdf = PDF::loadView('merchant.customer.facture');
        return $pdf->stream();
    }
}
