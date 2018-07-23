@if(count($completed_orders) > 0)
    <div class="content" id="order_history">
        <!-- Start :: Pagination -->
        @include('front.customer.profilepagination', array('items' => $completed_orders))
        <!-- End :: Pagination -->
        <div class="col-md-12">
        @foreach($completed_orders as $shipped_order)
            <div class="col-md-6">

                <div class="row">
                    <span class="user-data"><strong>Order Number: </strong></span>
                    <span class="user-data">{!! $shipped_order->order_id !!}</span>
                </div>

                <div class="row">
                    <span class="user-data"><strong>Order Date:</strong></span>
                    <span class="user-data">{!! formatDate($shipped_order->order_date, "M dS, Y") !!}</span>
                </div>

                <div class="row">
                    <span class="user-data"><strong>Order Total:</strong></span>
                    <span class="user-data">{!! format_price($shipped_order->total, 'price') !!}</span>
                </div>

                <div class="row">
                    <span class="user-data"><strong>Status:</strong></span>
                    <span class="user-data">{!! ($shipped_order->status)?$shipped_order->status->customer_status:'' !!}</span>
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