@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Product Billed
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Product Billed</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Product Name</th>
                                <th>Customer Name</th>
                                <th>Merchant Name</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($order_items as $order_item)
                            <tr>
                                <td>{!! $order_item->order_id !!}</td>
                                <td>{!! $order_item->product_name !!}</td>
                                <td>{!! isset($order_item->order->customer)?$order_item->order->customer->first_name." ".$order_item->order->customer->last_name:"--" !!}</td>
                                <td>{!! ((!empty($order_item->itemRequest) && count($order_item->itemRequest) > 0) ? $order_item->itemRequest->first()->merchant->first_name." ".$order_item->itemRequest->first()->merchant->last_name:'') !!}</td>
                                <td><span class="label label-warning">{!! (count($order_item->status) > 0)?$order_item->status->status_name:'--' !!}</span></td>
                                <td>{!! convertDate($order_item->order->order_date) !!}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{!! url('admin/product-billed-detail/'.$order_item->order_item_id) !!}"  class="btn btn-default btn-sm" title="View"><i class="fa fa-fw fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                           @endforeach
                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('additional-scripts')
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
@stop
@section('footer-scripts')
  {!! Html::script('backend/js/product-billed.js') !!}
@stop
