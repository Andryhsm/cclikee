@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Coupons
        </h1>
        
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Coupons</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Coupon Code</th>
                                <th>Customer Name</th>
                                <th>Merchant Name</th>
                                <th>Amount</th>
                                <th>Created Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $coupon)
                            <tr>
                                <td>{!! $coupon->coupon_code !!}</td>
                                <td>{!! $coupon->orderItem->order->customer->first_name !!}</td>
                                <td>Toy Shop</td>
                                <td>${!! $coupon->amount !!}</td>
                                <td>March 25, 2017</td>
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
    {!! Html::script('backend/js/coupon.js') !!}

@stop
