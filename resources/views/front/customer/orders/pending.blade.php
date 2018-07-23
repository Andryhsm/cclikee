@if (count($pending_orders) > 0)
    <div class="content" id="order_paging">
        <!-- Start :: Pagination -->
        @include('front.customer.profilepagination', array('items' => $pending_orders))
        <!-- End :: Pagination -->
        <div class="col-md-12">
        @foreach ($pending_orders as $order)
            <div class="col-md-6">
                <div class="row">
                    <span class="user-data"><strong>Order Number: </strong></span>
                    <span class="user-data">{!! $order->order_id !!}</span>
                </div>

                <div class="row">
                    <span class="user-data"><strong>Order Date:</strong></span>
                    <span class="user-data">{!! formatDate($order->order_date, "M dS, Y") !!}</span>
                </div>

                @if( isset($order->shipping->first_name) && isset($order->shipping->last_name)  &&  trim($order->shipping->first_name . '' . $order->shipping->last_name != ""))
                    <div class="row">
                        <span class="user-data"><strong>Ship To:</strong></span>
                        <span class="user-data">{!! $order->shipping->first_name . ' ' . $order->shipping->last_name !!}</span>
                    </div>
                @endif

                <div class="row">
                    <span class="user-data"><strong>Order Total:</strong></span>
                    <span class="user-data">{!! format_price($order->total, 'price') !!}</span>
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