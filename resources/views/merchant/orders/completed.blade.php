@if(count($results) > 0)
    <div class="content col-md-12" id="merchant-orders-content">
        <!-- Start :: Pagination -->
        @include('customer.profilepagination', array('items' => $results))
                <!-- End :: Pagination -->
        <div class="row margin-top-xxl">
            @foreach($results as $item)
                <div class="col-md-6">
                    <div class="row">
                        <span class="user-data"><strong>Order Number: </strong></span>
                        <span class="user-data">{!! $item->order_id !!}</span>
                    </div>
                    <div class="row">
                        <span class="user-data"><strong>Order Date:</strong></span>
                        <span class="user-data">{!! formatDate($item->order->order_date, "M dS, Y") !!}</span>
                    </div>
                    <div class="row">
                        <span class="user-data"><strong>Product:</strong></span>
                        <span class="user-data">{!! $item->product_name !!}</span>
                    </div>

                    <div class="row">
                        <span class="user-data"><strong>Price:</strong></span>
                        <span class="user-data">{!! format_price($item->final_price, 'price') !!}</span>
                    </div>

                    <div class="row">
                        <span class="user-data"><strong>Status:</strong></span>
                        <span class="user-data">{!! ($item->order->status)?$item->order->status->customer_status:'' !!}</span>
                    </div>

                </div>
                <!-- /.col-6 -->
            @endforeach
        </div>
    </div>
    <!-- /.content -->
@else
    <p>No record found.</p>
@endif