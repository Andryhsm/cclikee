@extends($layout)
@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop

@section('content')
    <section class="content-header">
        @include('notification')
        <h1>
            Create Invoice
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="box-body">
                <div class="col-md-12">
                    {!! Form::open(['url' =>url("admin/invoice"), 'class' => '','id' =>'invoice_form','method'=>'post']) !!}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="pull-left">Merchant Information</h4>
                            <a href="#merchant-modal" data-toggle="modal" data-target="#merchant-modal" class="pull-right select-customer">Select existing Merchant</a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body form-group form-group-sm">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control margin-bottom copy-input" name="merchant_name" id="merchant_name" placeholder="Enter name" disabled="">
                                    </div>
                                    <div class="input-group float-right margin-bottom">
                                        <span class="input-group-addon">@</span>
                                        <input type="email" class="form-control copy-input " name="merchant_email" id="merchant_email" placeholder="E-mail address" disabled>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control margin-bottom copy-input" name="merchant_address_2" id="merchant_address_2" placeholder="Address 2" disabled="">
                                    </div>
                                    <div class="form-group no-margin-bottom">
                                        <input type="text" class="form-control copy-input " name="customer_postcode" id="merchant_postcode" placeholder="Postcode" disabled>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control margin-bottom copy-input" name="store_name" id="store_name" placeholder="Store name" disabled>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control copy-input" name="merchant_address_1" id="merchant_address_1" placeholder="Address 1" disabled>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control margin-bottom copy-input " name="merchant_city" id="city" placeholder="City" disabled>
                                    </div>
                                    <div class="form-group no-margin-bottom">
                                        <input type="text" class="form-control" name="customer_phone" id="merchant_phone" placeholder="Phone number" disabled>
                                    </div>
                                </div>
                                <input type="hidden" name="merchant_id" id="merchant_id" value="">
                                <input type="hidden" name="store_id" id="store_id" value="">
                            </div>
                        </div>

                        <div class="panel-body form-group form-group-sm">
                            <div class="row">
                                <table class="table table-bordered" id="items_table">
                                    <thead>
                                    <tr>
                                        <th width="70%">
                                            <h4>
                                                <a href="#items-modal" data-toggle="modal" data-target="#items-modal" class="btn btn-success btn-xs add-row"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a> Item(s)
                                            </h4>
                                        </th>
                                        <th width="15%">
                                            <h4>Price</h4>
                                        </th>
                                        <th width="15%">
                                            <h4>Commission</h4>
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="invoice_totals" class="padding-right row text-right">
                            <div class="col-xs-6">
                                <div class="input-group form-group-sm order-notes no-margin-bottom">
                                    <textarea class="form-control invoice_notes" name="invoice_notes" placeholder="Please enter any order notes here."></textarea>
                                </div>
                            </div>
                            <div class="col-xs-6 no-padding-right">
                                <div class="row">
                                    <div class="col-xs-4 col-xs-offset-5">
                                        <strong>Sub Total:</strong>
                                    </div>
                                    <div class="col-xs-3">
                                        $<span class="invoice-sub-total">0.00</span>
                                        <input type="hidden"  name="invoice_subtotal" id="invoice_subtotal" value="0.00">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-xs-offset-5">
                                        <strong>Total:</strong>
                                    </div>
                                    <div class="col-xs-3">
                                        $<span class="invoice-total">0.00</span>
                                        <input type="hidden" name="invoice_total" id="invoice_total" value="0.00">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xs-12 margin-top btn-group">
                                <button type="submit" id="action_create_invoice" class="mr-b-15 mr-r-5 btn btn-success pull-right">Create Invoice</button>
                            </div>
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="merchant-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">All Merchant</h4>
                </div>
                <div class="modal-body">
                    <table id="merchant-lists" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Merchant Name</th>
                            <th>Email Address</th>
                            <th>Shop Name</th>
                            <th class="no-sort">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($merchants as $user)
                            @foreach($user->store as $store)
                            <tr>
                                <td>{!! $user->first_name." ".$user->last_name !!}</td>
                                <td>{!! $user->email !!}</td>
                                <td>{!! $store->store_name !!}</td>
                                <td>
                                    <button type="button" id="select-merchant" class="btn btn-success" data-id="{!! $user->user_id !!}"
                                            data-store_id="{!! $store->store_id !!}"
                                            data-name="{!! $user->first_name." ".$user->last_name !!}"
                                            data-email="{!! $user->email !!}"
                                            data-address_1="{!! $store->address1 !!}"
                                            data-address_2="{!! $store->address2 !!}"
                                            data-city="{!! $store->city !!}"
                                            data-zip="{!! $store->zip !!}"
                                            data-phone="{!! $store->phone !!}"
                                            data-store_name="{!! $store->store_name !!}"
                                    >
                                        Select</button>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="items-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">All Items</h4>
                </div>
                <div class="modal-body">
                    <select class="form-control item-select" id="item_dropdown">
                     @foreach($items as $item)
                        <option value="{!! $item->order_item_id !!}" data-price="{!! $item->final_price !!}" data-name="{!! $item->product_name !!}">
                            {!! $item->product_name." (#".$item->order_item_id.")" !!}
                        </option>
                     @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="select_item" data-dismiss="modal">Add</button>
                    <button type="button" id="close_item_popup" class="btn btn-default">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop
@section('additional-scripts')
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
    {!! Html::script('backend/js/invoice.js') !!}
@stop

@section('footer-scripts')
@stop